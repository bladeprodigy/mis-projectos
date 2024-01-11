import React from 'react';
import {Alert, Box, Button, Container, TextField, Typography} from '@mui/material';
import {useNavigate} from "react-router-dom";

function Register() {
    const navigate = useNavigate();
    const [errorMessage, setErrorMessage] = React.useState('');

    const handleRegister = async (event) => {
        event.preventDefault();
        const data = new FormData(event.currentTarget);

        // Construct the payload
        const payload = {
            username: data.get('username'),
            email: data.get('email'),
            password: data.get('password'),
            password_confirmation: data.get('confirmPassword'),
        };

        // API endpoint
        const url = 'https://laravelfinalproject.azurewebsites.net/register';

        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(payload),
            });

            const result = await response.json();

            if (response.ok) {
                navigate('/login'); // Redirect to login page on successful registration
            } else {
                // Handle errors
                setErrorMessage(result.message || 'Registration failed');
            }
        } catch (error) {
            // Handle network errors
            console.error('Error:', error);
            setErrorMessage('Network error');
        }
    };

    return (
        <Container component="main" maxWidth="xs">
            <Box
                sx={{
                    display: 'flex',
                    flexDirection: 'column',
                    alignItems: 'center',
                    minHeight: '100vh',
                    justifyContent: 'center'
                }}
            >
                <Typography component="h1" variant="h5">
                    Register
                </Typography>
                {errorMessage && <Alert severity="error">{errorMessage}</Alert>}
                <Box component="form" onSubmit={handleRegister} sx={{ mt: 1 }}>
                    <TextField
                        margin="normal"
                        required
                        fullWidth
                        label="Username"
                        name="username"
                        autoComplete="username"
                    />
                    <TextField
                        margin="normal"
                        required
                        fullWidth
                        label="Email Address"
                        name="email"
                        autoComplete="email"
                    />
                    <TextField
                        margin="normal"
                        required
                        fullWidth
                        name="password"
                        label="Password"
                        type="password"
                        autoComplete="new-password"
                    />
                    <TextField
                        margin="normal"
                        required
                        fullWidth
                        name="confirmPassword"
                        label="Confirm Password"
                        type="password"
                        autoComplete="new-password"
                    />
                    <Button
                        type="submit"
                        fullWidth
                        variant="contained"
                        sx={{ mt: 3, mb: 2 }}
                    >
                        Register
                    </Button>
                </Box>
            </Box>
        </Container>
    );
}

export default Register;