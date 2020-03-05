import React, { Component } from 'react';
import cookie from 'js-cookie';
import Nav from './Nav';
class Add_note extends Component {
	constructor(props) {
		super(props);
		this.takeValueFromInput = this.takeValueFromInput.bind(this);
		this.addNoteSubmit = this.addNoteSubmit.bind(this);
		this.state = {
			note_title: '',
			note_description: '',
			ipAdd: '',
			newArr: []
		};
	}
	//Handle form data
	takeValueFromInput(e) {
		this.setState({
			[e.target.name]: e.target.value
		});
	}

	componentDidMount() {
		//Get IP address for saving data to local storage if user is not logged in
		axios
			.get('http://localhost:8000/api/userip')
			.then((res) => {
				this.setState({
					ipAdd: res.data
				});
			})
			.catch((error) => {
				console.log(error);
			});
	}

	//Note Submit form
	addNoteSubmit(e) {
		e.preventDefault();
		let getTokenCookie = cookie.get('token');
		//Check that user is login or not. If not then store data in localStorage.
		if (getTokenCookie !== undefined) {
			let getUser = cookie.get('user');
			//user is logged in so store data to mysql database.
			getUser = JSON.parse(getUser);
			axios
				.post(`http://localhost:8000/api/notes`, {
					user_id: getUser.id,
					note_title: this.state.note_title,
					note_description: this.state.note_description
				})
				//handle promise
				.then((res) => {
					console.log('Note successfull added');
					alert('Note successfull added');
				})
				.catch((error) => {
					console.log(error.response.data.error);
				});
		} else {
			/*
                   If user is not logged in then client request come into this block.
                   And store data to localstorage where key is device ip address (that help to identify user when he will log in)  
                   */
			var localValue = this.state.ipAdd + '_addNote';
			let { note_title, note_description } = this.state;
			let value = {
				one: note_title,
				two: note_description
			};
			if (JSON.parse(window.localStorage.getItem(localValue)) !== null) {
				/*
                        Convert localstorage data into array of objects (json parse). at first take the previous data then concat with new client inputs.
                        */
				let previous = Array.from(JSON.parse(window.localStorage.getItem(localValue)));
				//after concat convert data to string and store in localstorage.
				window.localStorage.setItem(localValue, JSON.stringify(previous.concat(Array.from([ value ]))));
				alert('Note successfull added');
			} else {
				//when localstorage is empty, then set data to localstorage.
				let empty = [];
				empty.push(value);
				window.localStorage.setItem(localValue, JSON.stringify(empty));
				alert('Note successfull added');
			}
		}
	}
	render() {
		let { note_title, note_description, contact } = this.state;
		return (
			<div className="container">
				<div className="row justify-content-center">
					<div className="col-md-8">
						<div className="card">
							<div className="card-header">
								<Nav />
							</div>
							<form onSubmit={this.addNoteSubmit}>
								<div className="row mb-2 mt-2">
									<div className="col-md-3 mt-1 text-right">
										<b>Note Title:</b>
									</div>
									<div className="col-md-8">
										<input
											required=""
											type="text"
											name="note_title"
											value={note_title}
											placeholder="enter note title.."
											className="form-control"
											onChange={this.takeValueFromInput}
										/>
									</div>
								</div>
								<div className="row mb-2">
									<div className="col-md-3 mt-1 text-right">
										<b>Note Description:</b>
									</div>
									<div className="col-md-8">
										<input
											type="text"
											name="note_description"
											value={note_description}
											placeholder="enter note description.."
											className="form-control"
											onChange={this.takeValueFromInput}
										/>
									</div>
								</div>
								<div className="row mb-2">
									<div className="col-md-3 mt-1 text-right" />
									<div className="col-md-8">
										<input type="submit" className="btn btn-sm btn-outline-info" />
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		);
	}
}
export default Add_note;
