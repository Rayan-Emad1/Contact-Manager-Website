import React, { useState } from 'react';
 import axios from 'axios';
 
const SignIn = () => {
  const [phoneNumber, setPhoneNumber] = useState('');
  const [password, setPassword] = useState('');

 

const handleSignIn = async () => {
  try {
    const response = await axios.post('http://127.0.0.1:8000/api/signin', {
      phone_number: phoneNumber,
      password: password,
    });

    const data = response.data;

    if (data.status === 'Success') {
      console.log('Token:', data.user.token);
      localStorage.setItem('token', data.user.token);
      // redirectToMainPage();
    } else {
      console.log('Signin failed:', data.message);
    }
  } catch (error) {
    console.log('Error:', error);
  }
};

  return (
    <div>
      <h1>Sign In</h1>
      <div>
        <label>Phone Number:</label>
        <input type="text" value={phoneNumber} onChange={(e) => setPhoneNumber(e.target.value)} />
      </div>
      <div>
        <label>Password:</label>
        <input type="password" value={password} onChange={(e) => setPassword(e.target.value)} />
      </div>
      <div>
        <button onClick={handleSignIn}>Sign In</button>
      </div>
    </div>
  );
};

export default SignIn;
