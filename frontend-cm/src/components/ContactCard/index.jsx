import React from 'react';
import './ContactCard.css';

const ContactCard = ({ contact }) => {
  return (
    <div className='card'>
      <p>Name: {contact.contact_name}</p>
      <p>Phone Number: {contact.contact_number}</p>
      <p>Latitude: {contact.latitude}</p>
      <p>Longitude: {contact.longitude}</p>
    </div>
  );
};

export default ContactCard;
