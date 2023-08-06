import React, { useState } from 'react';

const ContactForm = ({ addContact }) => {
  const [name, setName] = useState('');
  const [phoneNumber, setPhoneNumber] = useState('');
  const [latitude, setLatitude] = useState('');
  const [longitude, setLongitude] = useState('');

  const handleAddContact = () => {
    const newContact = {
      name,
      phone_number: phoneNumber,
      latitude,
      longitude,
    };
    addContact(newContact);
    setName('');
    setPhoneNumber('');
    setLatitude('');
    setLongitude('');
  };

  return (
    <div>
      <h2>Add Contact</h2>
      <div>
        <label>Name:</label>
        <input type="text" value={name} onChange={(e) => setName(e.target.value)} />
      </div>
      <div>
        <label>Phone Number:</label>
        <input type="text" value={phoneNumber} onChange={(e) => setPhoneNumber(e.target.value)} />
      </div>
      <div>
        <label>Latitude:</label>
        <input type="text" value={latitude} onChange={(e) => setLatitude(e.target.value)} />
      </div>
      <div>
        <label>Longitude:</label>
        <input type="text" value={longitude} onChange={(e) => setLongitude(e.target.value)} />
      </div>
      <div>
        <button onClick={handleAddContact}>Add Contact</button>
      </div>
    </div>
  );
};

export default ContactForm;
