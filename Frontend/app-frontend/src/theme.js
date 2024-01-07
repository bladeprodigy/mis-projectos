import { createTheme } from '@mui/material/styles';

import '@fontsource/roboto/300.css';
import '@fontsource/lato/400.css';

const theme = createTheme({
    palette: {
        primary: {
            main: '#003366',
            dark: '#002244',
            light: '#334b66',
            contrastText: '#ffffff',
        },
        secondary: {
            main: '#b2bec3',
            contrastText: '#ffffff',
        },
        background: {
            default: '#f0f0f0',
            paper: '#ffffff',
        },
    },
    typography: {
        fontFamily: 'Roboto, sans-serif',
        h3: {
            fontFamily: 'Lato, sans-serif',
            fontWeight: 400,
        },
        h5: {
            fontWeight: 400,
        },
        button: {
            fontWeight: 400,
        },
    },
    components: {
        MuiButton: {
            styleOverrides: {
                root: {
                    borderRadius: 8,
                    padding: '10px 20px',
                    textTransform: 'none',
                },
            },
        },
    },
    shadows: Array(25).fill('none'),
});

theme.shadows[1] = '0px 2px 1px -1px rgba(0,0,0,0.2),0px 1px 1px 0px rgba(0,0,0,0.14),0px 1px 3px 0px rgba(0,0,0,0.12)';

export default theme;
