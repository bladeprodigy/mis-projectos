import React from 'react';
import { Box, Typography, useMediaQuery } from '@mui/material';
import theme from '../theme';

function Header() {
    const matches = useMediaQuery(theme.breakpoints.up('sm'));

    return (
        <Box sx={{
            flexGrow: 0,
            background: `linear-gradient(45deg, ${theme.palette.primary.dark} 30%, ${theme.palette.primary.light} 90%)`,
            color: theme.palette.secondary.contrastText,
            display: 'flex',
            justifyContent: 'center',
            alignItems: 'center',
            padding: matches ? '2rem' : '1rem',
        }}>
            <Typography variant="h3">MIS PROYECTOS</Typography>
        </Box>
    );
}

export default Header;
