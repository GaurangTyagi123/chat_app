/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

import './bootstrap';

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import UserList from './components/UserList';
import ChatContent from './components/chatContent';
import reactDOM from 'react-dom/client';
import React from 'react';

const chat_list = document.getElementById("chat_list");
const chat_container = document.getElementById('chat_container');


if (chat_list) {
    reactDOM.createRoot(chat_list).render(
        <UserList/>
    )
}
if (chat_container) {
    reactDOM.createRoot(chat_container).render(
        <ChatContent/>
    )
}

