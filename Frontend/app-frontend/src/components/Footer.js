import React from 'react';
import { Box, Typography } from '@mui/material';
import theme from '../theme';

function Footer() {
    return (
        <Box sx={{
            flexGrow: 0,
            backgroundColor: theme.palette.primary.dark,
            color: theme.palette.background.default,
            textAlign: 'center',
            padding: '0.5rem 0',
        }}>
            <Typography variant="body1">FOOTER</Typography>
        </Box>
    );
}

export default Footer;
