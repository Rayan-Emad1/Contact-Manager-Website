import React from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import SignIn from './Pages/Signin';
import SignUp from './Pages/Signup';
import ContactListContainer from './components/ContactListContainer';

function App() {
  return (
    <Router>
      <div className="App">
        <header className="App-header">
          <Routes>
            <Route path="/signin" element={<SignIn />} />
            <Route path="/signup" element={<SignUp />} />
            <Route path="/contact-list" element={<ContactListContainer />} />
          </Routes>
        </header>
      </div>
    </Router>
  );
}

export default App;
