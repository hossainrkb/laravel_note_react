import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Modal from 'react-modal';
import cookie from 'js-cookie';
import Nav from './Nav';
const initialState = {
	note: [],
	localStorageData: [],
	ipAdd: '',
	modalIsOpenExp: false,
	modalIsOpen: false,
	noteId: '',
	eachNode: '',
	edit_note: '',
	update_title: '',
	update_des: '',
	user_notes: [],
	delete_successfull: ''
};
const customStyles = {
	content: {
		top: '50%',
		left: '50%',
		right: 'auto',
		bottom: 'auto',
		marginRight: '-50%',
		transform: 'translate(-50%, -50%)'
	}
};
class Note_list extends Component {
	constructor(props) {
		super(props);
		this.state = initialState;
		this.deleteUserNotes = this.deleteUserNotes.bind(this);
		this.updateNote = this.updateNote.bind(this);
		this.takeUpdateNoteValueFromInput = this.takeUpdateNoteValueFromInput.bind(this);
		this.openModal = this.openModal.bind(this);
		this.afterOpenModal = this.afterOpenModal.bind(this);
		this.closeModal = this.closeModal.bind(this);
	}

	componentDidMount() {
		let getTokenCookie = cookie.get('token');
		//Check cookie is available or not in cookies
		if (getTokenCookie !== undefined) {
			console.log('undefinde=>>>>>>>>>>>>>>>>>>>>');
			//if cookie is available then get user notes.
			let getUser = cookie.get('user');
			getUser = JSON.parse(getUser);
			axios
				.get(`http://localhost:8000/api/user_notes/${getUser.id}`)
				.then((res) => {
					// If promise resolve then store data in user_note (state)
					this.setState({
						user_notes: res.data
					});
				})
				.catch((error) => {
					//handling error
					console.log(error);
				});
		} else {
			console.log('bro here=>>>>>>>>>>>>>>>>>>>>');
			/* If user is not log in means (not token in localstorage) 
          then comes to this block
          */
			//get user IP address
			axios
				.get('http://localhost:8000/api/userip')
				.then((res) => {
					var localValue = res.data + '_addNote';
					if (JSON.parse(window.localStorage.getItem(localValue)) !== null) {
						// Get data from local storage and save it to array (localStorageData)
						this.setState({
							localStorageData: JSON.parse(window.localStorage.getItem(localValue))
						});
					} else {
					}
				})
				.catch((error) => {
					//handle reject
					console.log(error);
				});
		}
	}

	//Delete Note Handle
	deleteUserNotes(index) {
		let getTokenCookie = cookie.get('token');

		//Check that user is logged in or not if logged in then delete note from database and if not logged in then delete feom localstorage array.
		if (getTokenCookie !== undefined) {
			let getUser = cookie.get('user');
			getUser = JSON.parse(getUser);
			axios
				.delete(`http://localhost:8000/api/notes/${index}`)
				.then((res) => {
                    alert("Note delete successfull")
					this.setState({
						delete_successfull: res.data
					});
					//After Delete then re-render all value.
					axios
						.get(`http://localhost:8000/api/user_notes/${getUser.id}`)
						.then((res) => {
							this.setState({
								user_notes: res.data
							});
						})
						.catch((error) => {
							console.log(error);
						});
				})
				.catch((error) => {
					console.log(error);
				});
		} else {
			/*If user not logged in then comes to this block.
            and delete from localstorage 
           */
			let newData = Object.assign([], this.state.localStorageData);
			/*
            use splice method to delete specific index that hit to parent array (pass by value)
            */
			newData.splice(index, 1);
			//after delete get new localstorage value
			this.setState({
				localStorageData: newData
			});
			//re render on web page after delete (get ip for indentify user)
			axios
				.get('http://localhost:8000/api/userip')
				.then((res) => {
					var localValue = res.data + '_addNote';
					//remove old storage value
					localStorage.removeItem(localValue);
					//set new array to localstorage
					window.localStorage.setItem(localValue, JSON.stringify(this.state.localStorageData));
                alert("Note delete successfull")
                })
				.catch((error) => {
					console.log(error);
				});
		}
	}

	//Update Note Handle
	updateNote(e) {
		e.preventDefault();
		let getTokenCookie = cookie.get('token');
		/*Check user is logged in or not if logged in then update database query.
         if not logged in then update array from localstorege.
        */
		if (getTokenCookie !== undefined) {
			//if user logged in then enter into this block
			let getUser = cookie.get('user');
			getUser = JSON.parse(getUser);
			//get form data
			let data = {
				note_title: this.state.update_title,
				note_description: this.state.update_des
			};
			//send network request to server for updating specific row from database
			axios
				.put(`http://localhost:8000/api/notes/${this.state.noteId}`, data)
				.then((response) => {
					console.log('updated successfull==========>', response.data);
					//After update re render all user notes.
					axios
						.get(`http://localhost:8000/api/user_notes/${getUser.id}`)
						.then((res) => {
							//change the user_note state
							this.setState({
								user_notes: res.data
							});
						})
						.catch((error) => {
							console.log(error);
						});
				})
				.catch((error) => {
					console.log(error);
				});
			//
		} else {
			//if user is not logged in then request comes to this block.
			let id = this.state.noteId;
			//assign all notes into new array. (which we will return after updating notes)
			let newData = Object.assign([], this.state.localStorageData);
			let newIndexedUserNotes = Object.assign({}, newData[id]);
			console.log('new node=================> ', newIndexedUserNotes);
			newIndexedUserNotes.one = this.state.update_title;
			newIndexedUserNotes.two = this.state.update_des;
			newData[id] = newIndexedUserNotes;
			//after updating store new Updated data into state.
			this.setState({
				localStorageData: newData
			});
			//then set the state value to localstorage. (towards specific IP address)
			axios
				.get('http://localhost:8000/api/userip')
				.then((res) => {
					var localValue = res.data + '_addNote';
					localStorage.removeItem(localValue);
					window.localStorage.setItem(localValue, JSON.stringify(this.state.localStorageData));
				})
				.catch((error) => {
					console.log(error);
				});
		}
	}

	//Handle form Value
	takeUpdateNoteValueFromInput(e) {
		this.setState({
			[e.target.name]: e.target.value
		});
	}

	// Use React Modal for updating notes.
	openModal(id) {
		let getTokenCookie = cookie.get('token');

		console.log('ggags');
		if (getTokenCookie !== undefined) {
			let getUser = cookie.get('user');
			getUser = JSON.parse(getUser);
			axios
				.get(`http://localhost:8000/api/notes/${id}`)
				.then((res) => {
					this.setState({
						edit_note: res.data,
						modalIsOpen: true,
						noteId: id
					});
				})
				.catch((error) => {
					console.log(error);
				});
		} else {
			this.setState({
				modalIsOpen: true,
				noteId: id,
				eachNode: this.state.localStorageData[id]
			});
		}
	}
	//handle modal css
	afterOpenModal() {
		this.subtitle.style.color = '#f00';
	}

	closeModal() {
		this.setState({ modalIsOpen: false });
	}
	render() {
		let { localStorageData, user_notes } = this.state;
		console.log(cookie.get('user'));
		return (
			<div className="container">
				<div className="row justify-content-center">
					<div className="col-md-8">
						<div className="card">
							<div className="card-header">
								<Nav />
							</div>
							{localStorageData.length > 0 ? (
								<table className=" text-center table table-border table-hover table-condense">
									<thead>
										<tr>
											<td>
												<b>Count</b>
											</td>
											<td>
												<b>Note Title</b>
											</td>
											<td>
												<b>Note Descriptions</b>
											</td>
											<td colSpan="2">
												<b>Actions</b>
											</td>
										</tr>
									</thead>
									{localStorageData.map((each, index) => (
										<tr key={index} className="">
											<td>{index + 1}</td>
											<td>{each.one}</td>
											<td>{each.two}</td>
											<td>
												<button
													onClick={this.deleteUserNotes.bind(this, index)}
													className="badge btn btn-sm btn-outline-danger"
												>
													Delete
												</button>
												<button
													className="badge btn btn-sm btn-outline-primary ml-1"
													onClick={this.openModal.bind(this, index)}
												>
													Update Note
												</button>
											</td>
										</tr>
									))}
								</table>
							) : //
							user_notes.length > 0 ? (
								<table className=" text-center table table-border table-hover table-condense">
									<thead>
										<tr>
											<td>
												<b>Count</b>
											</td>
											<td>
												<b>Note Title</b>
											</td>
											<td>
												<b>Note Descriptions</b>
											</td>
											<td colSpan="2">
												<b>Actions</b>
											</td>
										</tr>
									</thead>
									{user_notes.map((each, index) => (
										<tr key={index} className="">
											<td>{index + 1}</td>
											<td>{each.note_title}</td>
											<td>{each.note_description}</td>
											<td>
												<button
													onClick={this.deleteUserNotes.bind(this, each.id)}
													className="badge btn btn-sm btn-outline-danger"
												>
													Delete
												</button>
												<button
													className="badge btn btn-sm btn-outline-primary ml-1"
													onClick={this.openModal.bind(this, each.id)}
												>
													Update Note
												</button>
											</td>
										</tr>
									))}
								</table>
							) : (
								//
								<p>empty</p>
							)}
							<Modal
								isOpen={this.state.modalIsOpen}
								onAfterOpen={this.afterOpenModal}
								onRequestClose={this.closeModal}
								style={customStyles}
								contentLabel="Example Modal"
							>
								<h5 className="text-primary" ref={(subtitle) => (this.subtitle = subtitle)}>
									Update Note {this.state.noteId}
								</h5>
								{this.state.note_up_success && (
									<p className="text-danger text-center">{this.state.note_up_success}</p>
								)}
								<form onSubmit={this.updateNote}>
									<table className="table">
										<tr>
											<td>
												<b>Title:</b>{' '}
												{this.state.eachNode.one ? (
													this.state.eachNode.one
												) : (
													this.state.edit_note.note_title
												)}
											</td>
										</tr>
										<tr>
											<td>
												<b>Descriptions:</b>{' '}
												{this.state.eachNode.two ? (
													this.state.eachNode.two
												) : (
													this.state.edit_note.note_description
												)}
											</td>
										</tr>
									</table>
									<br />
									<input
										type="text"
										name="update_title"
										className="form-control"
										value={this.state.update_title}
										onChange={this.takeUpdateNoteValueFromInput}
										placeholder="Enter note title..."
									/>
									<br />
									<input
										type="text"
										name="update_des"
										className="form-control"
										value={this.state.update_des}
										onChange={this.takeUpdateNoteValueFromInput}
										placeholder="Enter note description..."
									/>
									<br />
									<button className="btn btn-sm btn-outline-danger float-right">Update Note</button>
								</form>
							</Modal>
						</div>
					</div>
				</div>
			</div>
		);
	}
}
export default Note_list;
