import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route, Switch, NavLink } from 'react-router-dom';
import Add_note from './Add_note';
import Note_list from './Note_list';
import User_login from './User_login';
import Nav from './Nav';
class Example extends Component {
	render() {
		return (
			<BrowserRouter>
            
				<NavLink style={{ fontSize: '17px' }} to="/add_note" exact>
					Add Note
				</NavLink>
				<NavLink style={{ fontSize: '17px' }} to="/notes" exact>
					Note List
				</NavLink>
				<NavLink style={{ fontSize: '17px' }} to="/user_login" exact>
					User Login
				</NavLink>
				<Switch>
					<Route path="/user_login" exact component={User_login} />
					<Route path="/add_note" exact component={Add_note} />
					<Route path="/notes" exact component={Note_list} />
				</Switch>
			</BrowserRouter>
		);
	}
}
export default Example;
if (document.getElementById('example')) {
	ReactDOM.render(<Example />, document.getElementById('example'));
}
