import axios from 'axios';
import React, { useState} from 'react';

function UserList() {
    const [users] = useState(data.users);
    console.log(url)
    return (
        <ul className='chat__list'>
            {users.map(user => {
                if(user.id !== data.user_id)
                    return <li className="chat__list__item" key={user.id} >
                        <a href={`${url}/show/${user.id}`} className='chat__list__link' style={{textDecoration: "none"}} data-online="false" data-id={user.id}>
                        <div className="chat__details">
                            <img src={`${url}/profile_pic.jpeg`} alt="gaurang tyagi" className='chat__details__img'/>
                            <span className='chat__details__name'>{user.name}</span>
                        </div>
                        </a>
                    </li>
            })}
            
        </ul>
    );
}

export default UserList;

