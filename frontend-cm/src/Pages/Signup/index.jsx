import React, { useState } from 'react';

const SignUp = () => {
  const [name, setName] = useState('');
  const [phoneNumber, setPhoneNumber] = useState('');
  const [password, setPassword] = useState('');

  const handleSignUp = async () => {
    try {
      const response = await fetch('http://127.0.0.1:8000/api/signup', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ name, phone_number: phoneNumber, password }),
      });

      const data = await response.json();

      if (data.status === 'success') {
        console.log('Token:', data.user.token);
        localStorage.setItem("token" , data.user.token)
        // redirectToMainPage();

      } else {
        console.log('Signup failed:', data.message);
      }
    } catch (error) {
      console.log('Error:', error);
    }
  };

  return (
    <div>
      <h1>Sign Up</h1>
      <div>
        <label>Name:</label>
        <input type="text" value={name} onChange={(e) => setName(e.target.value)} />
      </div>
      <div>
        <label>Phone Number:</label>
        <input type="text" value={phoneNumber} onChange={(e) => setPhoneNumber(e.target.value)} />
      </div>
      <div>
        <label>Password:</label>
        <input type="password" value={password} onChange={(e) => setPassword(e.target.value)} />
      </div>
      <div>
        <button onClick={handleSignUp}>Sign Up</button>
      </div>
    </div>
  );
};

export default SignUp;
