<?php

#[\AllowDynamicProperties]
class MY_Session extends CI_Session {
    public function destroy()
    {

        if ( ! $this->CI->input->is_ajax_request())
        {
            parent::destroy();
        }
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Update an existing session
     *
     * @return  void
     */
    public function update()
    {
        if ($this->CI->input->is_ajax_request())
        {
            return;
        }
        // We only update the session every five minutes by default
        if (($this->userdata['last_activity'] + $this->sess_time_to_update) >= $this->now)
        {
            return;
        }
        
        return parent::update();

        // _set_cookie() will handle this for us if we aren't using database sessions
        // by pushing all userdata to the cookie.
        $cookie_data = NULL;
        
        /*
        * begin old_session_id_changes
        *
        * Don't need to regenerate the session if we came in by indexing to
        * the old_session_id), but send out the cookie anyway to make sure
        * that the client has a copy of the new cookie.
        *
        * Do an isset check first in case we're not using the database to
        * store extra data.  The old_session_id field only exists in the
        * database.
        */
        if ((isset($this->userdata['old_session_id'])) &&
            ($this->cookie_session_id === $this->userdata['old_session_id']))
        {
            // set cookie explicitly to only have our session data
            $cookie_data = array();
            foreach (array('session_id','ip_address','user_agent','last_activity') as $val)
            {
                $cookie_data[$val] = $this->userdata[$val];
            }
        
            $this->_set_cookie($cookie_data);
            return;
        }
        /*
        * end old_session_id_changes
        */
        
        // Save the old session id so we know which record to
        // update in the database if we need it
        $old_sessid = $this->userdata['session_id'];
        $new_sessid = '';
        do
        {
            $new_sessid .= mt_rand(0, mt_getrandmax());
        }
        while (strlen($new_sessid) < 32);
        
        // To make the session ID even more secure we'll combine it with the user's IP
        $new_sessid .= $this->CI->input->ip_address();
        
        // Turn it into a hash and update the session data array
        $this->userdata['session_id'] = $new_sessid = md5(uniqid($new_sessid, TRUE));
        $this->userdata['last_activity'] = $this->now;
        
        // Write the cookie
        $this->_set_cookie($cookie_data);
    }
}
