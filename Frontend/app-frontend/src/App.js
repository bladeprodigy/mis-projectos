import React from 'react';
import {Box, CssBaseline, ThemeProvider} from '@mui/material';
import {BrowserRouter as Router, Route, Routes, useLocation} from 'react-router-dom';
import theme from './theme';
import Header from './components/Header';
import MainContent from './components/MainContent';
import Footer from './components/Footer';
import Login from './components/Login';
import Register from './components/Register';
import ProjectsPage from "./components/ProjectsPage";
import ProjectDetails from "./components/ProjectDetails";

function Layout() {
    const location = useLocation();
    const showLogout = location.pathname.startsWith('/projects');

    return (
        <Box sx={{ minHeight: '100vh', display: 'flex', flexDirection: 'column' }}>
            <Header showLogout={showLogout} />
            <Routes>
                <Route path="/" element={<MainContent />} />
                <Route path="/login" element={<Login />} />
                <Route path="/register" element={<Register />} />
                <Route path="/projects" element={<ProjectsPage />} />
                <Route path="/projects/:projectId" element={<ProjectDetails />} />
            </Routes>
            <Footer />
        </Box>
    );
}

function App() {
    return (
        <ThemeProvider theme={theme}>
            <CssBaseline />
            <Router>
                <Layout />
            </Router>
        </ThemeProvider>
    );
}

export default App;
