import React, { useState, useEffect } from 'react';
import ContactForm from '../ContactForm'; 
import ContactList from '../ContactList'; 
import './ContactList.css';

import { MyMap } from "../Map";



const ContactListContainer = () => {
  const [contacts, setContacts] = useState([]);

  const token = localStorage.getItem("token"); 


  const fetchContactList = async () => {
    try {
      const response = await fetch('http://127.0.0.1:8000/api/contact-list', {
        headers: {
          'Authorization': `Bearer ${token}`,
        },
      });
  
      if (!response.ok) {
        // Check for error response and handle it accordingly
        const errorData = await response.json();
        console.log('Error fetching contact list:', errorData.message);
      } else {
        const data = await response.json();
        setContacts(data.contact_lists);
      }
    } catch (error) {
      console.log('Error:', error);
    }
  };
  

  const addContact = async (newContact) => {
    try {
      const response = await fetch('http://127.0.0.1:8000/api/create-contact', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${token}`,
        },
        body: JSON.stringify(newContact),
      });

      if (!response.ok) {
        // Check for error response and handle it accordingly
        const errorData = await response.json();
        console.log('Error adding contact:', errorData.message);
      } else {
        const data = await response.json();
        setContacts([...contacts, data.contact]);
      }
    } catch (error) {
      console.log('Error:', error);
    }
  };

  useEffect(() => {
    fetchContactList();
  }, []);

  return (<>
    <h1>Contact List</h1>
    <MyMap contacts={contacts} />
    <div className="container">
      <div className="contact-form">
        <ContactForm addContact={addContact} />
      </div>
      <div className="contact-list">
        <ContactList contacts={contacts} />
      </div>
    </div>
    </>
  );
};

export default ContactListContainer;
