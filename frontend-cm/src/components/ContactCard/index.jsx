import React from 'react';

const ContactList = ({ contacts }) => {
  return (
    <div>
      <h2>Contact List</h2>
      {contacts.map((contact, index) => (
        <div key={index}>
          <p>Name: {contact.name}</p>
          <p>Phone Number: {contact.phone_number}</p>
          <p>Latitude: {contact.latitude}</p>
          <p>Longitude: {contact.longitude}</p>
        </div>
      ))}
    </div>
  );
};

export default ContactList;
