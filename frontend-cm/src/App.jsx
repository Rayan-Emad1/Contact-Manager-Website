import React from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import SignIn from './Pages/Signin';
import SignUp from './Pages/Signup';
import ContactListContainer from './components/ContactListContainer';

function App() {
  return(
    <Router>
      <div className="App">
        <header className="App-header">
          <Routes>
            <Route index element={<ContactListContainer />} />
            <Route path="/signin" element={<SignIn />} />
            <Route path="/signup" element={<SignUp />} />
          </Routes>
        </header>
      </div>
    </Router>

)}

export default App;
