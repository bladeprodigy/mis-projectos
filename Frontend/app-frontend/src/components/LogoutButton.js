// LogoutButton.js
import React, {useState} from 'react';
import {Button, Dialog, DialogActions, DialogContent, DialogContentText, DialogTitle} from '@mui/material';
import {useNavigate} from 'react-router-dom';

const LogoutButton = () => {
    const [open, setOpen] = useState(false);
    const navigate = useNavigate();

    const handleClickOpen = () => {
        setOpen(true);
    };

    const handleClose = () => {
        setOpen(false);
    };

    const handleLogout = () => {
        // Implement logout logic here, e.g., clearing user data, tokens, etc.
        console.log('User has logged out');
        // Redirect to login page or any other page
        navigate('/');
        handleClose();
    };

    return (
        <>
            <Button color="inherit" onClick={handleClickOpen}>
                Logout
            </Button>
            <Dialog open={open} onClose={handleClose}>
                <DialogTitle>Confirm Logout</DialogTitle>
                <DialogContent>
                    <DialogContentText>
                        Are you sure you want to logout?
                    </DialogContentText>
                </DialogContent>
                <DialogActions>
                    <Button onClick={handleClose} color="primary">
                        Cancel
                    </Button>
                    <Button onClick={handleLogout} color="primary" autoFocus>
                        Logout
                    </Button>
                </DialogActions>
            </Dialog>
        </>
    );
};

export default LogoutButton;