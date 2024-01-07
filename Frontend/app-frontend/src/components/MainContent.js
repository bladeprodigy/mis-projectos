import React from 'react';
import { useNavigate } from 'react-router-dom';
import { Box, Typography, Button } from '@mui/material';
import theme from '../theme';

function MainContent() {
    let navigate = useNavigate();

    return (
        <Box sx={{
            flexGrow: 1,
            display: 'flex',
            flexDirection: 'column',
            justifyContent: 'center',
            alignItems: 'center',
            padding: '2rem',
            textAlign: 'center',
            '& > * + *': {
                marginTop: '2rem',
            },
        }}>
            {/* Description */}
            <Box sx={{
                backgroundColor: theme.palette.background.paper,
                padding: '2rem',
                borderRadius: '4px',
                boxShadow: theme.shadows[1],
                maxWidth: '800px',
            }}>
                <Typography variant="h5">
                    Mis proyectos jest aplikacją, która pozwala na łatwe i szybkie zarządzenie twoimi projektami.
                    Pozwala ona na dodawanie, usuwanie, edytowanie oraz przeglądanie projektów.
                    Możesz łatwo podzielić swoje projekty ze względu na status jaki teraz jest.
                    Wszystko to za darmo!!!
                    Aplikacja jest stale wspierana i rozwijana, więc można spodziewać się nowych funkcjonalności.
                </Typography>
            </Box>

            {/* Buttons */}
            <Box>
                <Button
                    variant="contained"
                    color="secondary"
                    sx={{ margin: '0 1rem', boxShadow: theme.shadows[1] }}
                    onClick={() => navigate('/login')}
                >
                    Login
                </Button>
                <Button
                    variant="contained"
                    color="secondary"
                    sx={{ boxShadow: theme.shadows[1] }}
                    onClick={() => navigate('/register')}
                >
                    Register
                </Button>
            </Box>
        </Box>
    );
}

export default MainContent;
