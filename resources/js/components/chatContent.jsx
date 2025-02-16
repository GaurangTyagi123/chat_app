import axios from 'axios';
import React, { useEffect, useLayoutEffect, useState, createRef } from 'react'


function chatContent() {
  const displayRef = createRef()
  const chat = data !== 0 ? data.chat : false;
  const { chat_data } = chat ? chat : [];
  const [messages, setMessages] = useState([]);
  const [message, setMessage] = useState('')


  const sendChat = () => {
    if (message.length) {
      const chat_val = document.querySelector(".chat__input__text");
      chat_val.value = ""
      const meta_data = {
        user_id: data.user_id,
        chats_id: chat.id,
        message
      }
      axios.post(`http://localhost:8000/api/chat`, meta_data, { headers: { "X-Socket-Id": window.Echo.socketId() } }).then(res => {
        let response = res.data;
        setMessage('')
        setMessages(prevState => [...prevState, response].sort((a, b) => {
          return a.created_at - b.created_at
        }))
      })
    }
    else
      return;
  }
  useEffect(() => {
    const channel = window.Echo.join(`chat.${chat.id}`)
    channel.here((users) => {
      const user_list = document.querySelectorAll(".chat__list__link")
      Array.from(user_list).forEach(u => {
        const id = u.getAttribute('data-id');
        const user = users.filter(user => id == user.id)
        if (user.length > 0) {
          u.setAttribute('data-online', true)
        }
      })
    }).listen(".ChatMessage", (message) => {
      setMessages(prevState => [...prevState, message].sort((a, b) => {
        return a.created_at - b.created_at
      }))
    })

  }, [])
  useLayoutEffect(() => {
    let _ = chat_data.map(m => {
      if (m.chat.length > 0) {
        return JSON.parse(m.chat)
      }
      else
        return JSON.parse('{}')
    }).flat();
    _ = _.sort((a, b) => {
      return a.created_at - b.created_at
    })
    setMessages(_)
  }, [])
  if (chat_data) {
    return (
      <>
        <h3 className='chat__title'>{chat.chat_name}</h3>
        <ul className="chat__display" ref={displayRef}>
          {messages.map((ele, i) => {
            if (ele.id === data.user_id)
              return <li className='chat__message chat__message--sender' key={i}>{ele.message}</li>
            else if (ele.message)
              return <li className='chat__message chat__message--reciever' key={i}>{ele.message}</li>

          })}
        </ul>
        <div className="chat__input__group">
          <input type="text" className='chat__input__text' onChange={(e) => setMessage(e.target.value)} onKeyDown={(e) => {
            if (e.key.toLowerCase() === 'enter')
              sendChat()
          }}/>
          <svg aria-hidden="true" style={{ position: 'absolute', overflow: 'hidden', visibility: 'hidden' }} version="1.1"
            xmlns="http://www.w3.org/2000/svg" xmlnsXlink="http://www.w3.org/1999/xlink">
            <defs>
              <symbol id="icon-send" viewBox="0 0 20 20">
                <path d="M0 0l20 10-20 10v-20zM0 8v4l10-2-10-2z"></path>
              </symbol>
            </defs>
          </svg>
          <svg className="chat__input__submit" onClick={() => sendChat()}>
            <use xlinkHref="#icon-send"></use>
          </svg>
        </div>
      </>
    )
  }
  else
    return <div>Error</div>
}

export default chatContent;
