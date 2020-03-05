import React, { Component } from 'react';
import { Redirect } from 'react-router-dom';
import cookie from 'js-cookie';
const initialState = {
	user_email: '',
	user_password: '',
	isSubmitted: true,
	error: {},
	holaboi: '',
	success: ''
};

class User_login extends Component {
	constructor(props) {
		super(props);
		(this.state = initialState), (this.takeValueFromInput = this.takeValueFromInput.bind(this));
		this.UserLoginformSubmit = this.UserLoginformSubmit.bind(this);
	}

	//Handle user Login Form
	takeValueFromInput(e) {
		this.setState({
			[e.target.name]: e.target.value
		});
	}

	//Handle user login submit
	UserLoginformSubmit(e) {
		e.preventDefault();
		//take user information from state
		let { user_email, user_password } = this.state;
		//send network request to server
		axios
			.post(`http://localhost:8000/api/auth/login`, {
				email: user_email,
				password: user_password
			})
			.then((res) => {
				//reslove
				//if login successfull then set access token (JWT) to cookie
				cookie.set('token', res.data.access_token);
				cookie.set('user', res.data.user);
				/*
                after login sync the user and take all notes from localstorage then save it to database(mysql)
                */

				//get specific user ip address and take data from localstorage.
				axios
					.get('http://localhost:8000/api/userip')
					.then((responseip) => {
						var localValue = responseip.data + '_addNote';
						//localstorage string data parse into object array.
						console.log('localadsfadsfsdfsdf', window.localStorage.getItem(localValue));
						if (window.localStorage.getItem(localValue) !== null) {
							let data = JSON.parse(window.localStorage.getItem(localValue));
							data.map((each) => {
								axios
									.post(`http://localhost:8000/api/notes`, {
										user_id: res.data.user.id,
										note_title: each.one,
										note_description: each.two
									})
									.then((res) => {
										console.log('successfull insert to table notes');
									})
									.catch((error) => {
										console.log(error.response.data.error);
									});
							});
							//after insert delete lcoalstorage key.
							//From now data store in database till user click on logout button.
							window.localStorage.removeItem(localValue);
						}
						this.props.history.push('/notes');
					})
					.catch((error) => {
						//handle reject
						console.log(error);
					});

				//

				// this.props.setLogin(res.data.user);
			})
			.catch((error) => {
				console.log(error.response.data.error);
			});
	}
	render() {
		let { user_email, user_password, error } = this.state;
		return (
			<div className="container">
				<div className="row">
					<div className="col-md-6 offset-2">
						<h1 className="text-center">USER LOGIN</h1>
						<form onSubmit={this.UserLoginformSubmit}>
							<table className="table ">
								<tbody>
									<tr>
										<td>
											<label htmlFor="id">
												<b>USER EMAIL:</b>{' '}
											</label>
										</td>
										<td>
											<input
												type="text"
												className="form-control"
												name="user_email"
												id="id"
												value={user_email}
												onChange={this.takeValueFromInput}
											/>
											{error.contact && <div className="invalid-feedback">{error.contact}</div>}
										</td>
									</tr>
									<tr>
										<td>
											<label htmlFor="name">
												<b>PASSWORD:</b>{' '}
											</label>
										</td>
										<td>
											<input
												type="text"
												className="form-control"
												name="user_password"
												id="name"
												value={user_password}
												onChange={this.takeValueFromInput}
											/>
										</td>
									</tr>
									<tr>
										<td />

										<td>
											<button className="btn btn-sm btn-outline-info float-right">
												USER LOGIN
											</button>
										</td>
									</tr>
								</tbody>
							</table>
						</form>
					</div>
				</div>
			</div>
		);
	}
}

export default User_login;
