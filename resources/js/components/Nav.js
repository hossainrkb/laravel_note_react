import React, { Component } from 'react';
import { NavLink } from 'react-router-dom';
import cookie from 'js-cookie';
export default class Nav extends Component {
	constructor(props) {
		super(props);
		this.state = {
			key: '',
			user: ''
		};
		this.logout = this.logout.bind(this);
	}

	componentDidMount() {
		let getTokenCookie = cookie.get('token');
		//Check that user is login or not.
		if (getTokenCookie !== undefined) {
			let getUser = cookie.get('user');
			getUser = JSON.parse(getUser);
			this.setState({
				key: getTokenCookie,
				user: getUser
			});
		}
	}
	//logout handler
	logout() {
		//remove token and user from cookie storage
		cookie.remove('token');
		cookie.remove('user');
		this.setState({
			key: '',
			user: ''
		});
	}
	render() {
		return (
			<div>
				<nav className="navbar navbar-expand-sm bg-light">
					<ul className="navbar-nav ">
						<li className="nav-item">
							<NavLink
								className="nav-link btn btn-info btn-xs"
								activeStyle={{ fontSize: '17px' }}
								to="/add_note"
								exact
							>
								Add Note
							</NavLink>
						</li>
						<li className="nav-item">
							<NavLink
								className="nav-link btn btn-info btn-xs ml-2 "
								activeStyle={{ fontSize: '17px' }}
								to="/notes"
								exact
							>
								Note List
							</NavLink>
						</li>
						{this.state.key !== '' ? (
							<li className="nav-item">
								<NavLink
									className="nav-link btn btn-info btn-xs ml-2"
									activeStyle={{ fontSize: '17px' }}
									to=""
									exact
								>
									User Name: <b>{this.state.user.name}</b>
								</NavLink>
							</li>
						) : (
							<li className="nav-item">
								<NavLink
									className="nav-link btn btn-info btn-xs ml-2"
									activeStyle={{ fontSize: '17px' }}
									to="/user_login"
									exact
								>
									User Login
								</NavLink>
							</li>
						)}
						{this.state.key !== '' ? (
							<li className="nav-item">
								<button className="nav-link btn btn-info btn-xs ml-2" onClick={this.logout}>
									Logout
								</button>
							</li>
						) : (
							''
						)}
					</ul>
				</nav>
			</div>
		);
	}
}
