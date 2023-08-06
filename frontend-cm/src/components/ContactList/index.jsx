import React from 'react';
import ContactCard from '../ContactCard';
import "./CotactList.css"
const ContactList = ({ contacts }) => {
  if (!contacts) {
    return <div>Loading...</div>;
  }

  return (
    <>
    <h2>Contact List</h2>
    <div className='list'>  
      {contacts.map((contact, index) => (
        <ContactCard key={index} contact={contact} />
      ))}
    </div>
    </>
  );
};

export default ContactList;
