import React, {useState} from 'react';
import {
    Box, Button,
    Container,
    Paper,
    Table,
    TableBody,
    TableCell,
    TableContainer,
    TableHead,
    TableRow,
    ToggleButton,
    ToggleButtonGroup
} from '@mui/material';
import NewProjectDialog from "./NewProjectDialog";
import {useNavigate} from "react-router-dom";

const ongoingProjects = [
    { name: 'Ongoing Project 1', startDate: '09-14-2024', endDate: '03-12-2025', participants: 'Carol Johnson, Alice Smith, Dave Doe, Jane Brown, Dave Smith', description: 'Description of ongoing project 1. An in-depth look into the progress and milestones achieved.' },
    { name: 'Ongoing Project 2', startDate: '05-06-2024', endDate: '04-04-2025', participants: 'Bob Doe, Bob Davis, Carol Smith', description: 'Description of ongoing project 2. An in-depth look into the progress and milestones achieved.' },
    { name: 'Ongoing Project 3', startDate: '04-23-2024', endDate: '08-21-2025', participants: 'Bob Johnson, Dave Johnson, Jane Davis, Carol Davis', description: 'Description of ongoing project 3. An in-depth look into the progress and milestones achieved.' },
    { name: 'Ongoing Project 4', startDate: '10-15-2024', endDate: '03-30-2025', participants: 'Alice Brown, Bob Wilson, Bob Wilson, John Brown', description: 'Description of ongoing project 4. An in-depth look into the progress and milestones achieved.' },
    { name: 'Ongoing Project 5', startDate: '02-26-2024', endDate: '01-16-2025', participants: 'Dave Johnson, John Smith', description: 'Description of ongoing project 5. An in-depth look into the progress and milestones achieved.' }
];

const finishedProjects = [
    { name: 'Finished Project A', startDate: '01-01-2022', endDate: '02-02-2022', participants: 'Carol, Dave', description: 'A completed project with results' },
    { name: 'Finished Project B', startDate: '03-15-2022', endDate: '04-15-2022', participants: 'Alice, Bob, Charlie', description: 'A successful project that met all its goals.' },
    { name: 'Finished Project C', startDate: '05-20-2022', endDate: '06-22-2022', participants: 'Dave, Erin', description: 'Project completed with outstanding feedback.' },
    { name: 'Finished Project D', startDate: '07-03-2022', endDate: '08-14-2022', participants: 'Fiona, George', description: 'A project that had a significant impact on our operations.' },
    { name: 'Finished Project E', startDate: '09-10-2022', endDate: '10-12-2022', participants: 'Hannah, Ian, Jack', description: 'Finished ahead of schedule with excellent results.' }
];


function ProjectsPage() {
    const [view, setView] = useState('ongoing');
    const [projectsData, setProjectsData] = useState(ongoingProjects); // Initially show ongoing projects
    const navigate = useNavigate();

    const handleViewChange = (event, nextView) => {
        if (nextView !== null) {
            setView(nextView);
            // Simulate fetching data for the selected view
            if (nextView === 'ongoing') {
                setProjectsData(ongoingProjects);
            } else {
                setProjectsData(finishedProjects);
            }
        }
    };

    const [openDialog, setOpenDialog] = useState(false);

    const handleNewProjectClick = () => {
        setOpenDialog(true);
    };

    const handleCloseDialog = () => {
        setOpenDialog(false);
    };

    const handleCreateProject = (newProjectData) => {
        console.log(newProjectData);
        handleCloseDialog();
    };

    const handleRowClick = (projectName) => {
        // Navigate to the ProjectDetails page for the clicked project
        navigate(`/project/${encodeURIComponent(projectName)}`);
    }

    return (
        <Box
            sx={{
                display: 'flex',
                flexDirection: 'column',
                minHeight: '100vh',
                justifyContent: 'space-between',
            }}
        >
            <Container component="main" sx={{ flex: '1 0 auto', paddingTop: '64px', paddingBottom: '64px' }}>
                {/* Add this button to trigger the New Project Dialog */}
                <Box sx={{ display: 'flex', justifyContent: 'center', marginBottom: '40px' }}> {/* Increase marginBottom for more space */}
                    <Button variant="contained" onClick={handleNewProjectClick} sx={{ width: '200px' }}>Create New Project</Button>
                </Box>
                {/* New Project Dialog */}
                <NewProjectDialog
                    open={openDialog}
                    onClose={handleCloseDialog}
                    onCreate={handleCreateProject}
                />
                <Box sx={{ display: 'flex', justifyContent: 'center', marginBottom: '20px' }}>
                    <ToggleButtonGroup
                        color="primary"
                        value={view}
                        exclusive
                        onChange={handleViewChange}
                        sx={{ width: '50%', justifyContent: 'center' }} // Set the width as desired
                    >
                        <ToggleButton value="ongoing" sx={{ width: '50%' }}>Ongoing</ToggleButton>
                        <ToggleButton value="finished" sx={{ width: '50%' }}>Finished</ToggleButton>
                    </ToggleButtonGroup>
                </Box>
                <TableContainer component={Paper} sx={{ maxWidth: '95%', margin: 'auto' }}>
                    <Table aria-label="simple table" sx={{ minWidth: 650 }}>
                        <TableHead>
                            <TableRow>
                                <TableCell align="center">NAME</TableCell>
                                <TableCell align="center">START DATE</TableCell>
                                <TableCell align="center">END DATE</TableCell>
                                <TableCell align="center">PARTICIPANTS</TableCell>
                                <TableCell align="center">DESCRIPTION</TableCell>
                            </TableRow>
                        </TableHead>
                        <TableBody>
                            {projectsData.map((project, index) => (
                                <TableRow
                                    key={index}
                                    hover
                                    onClick={() => handleRowClick(project.name)}
                                    sx={{ cursor: 'pointer' }}
                                >
                                    <TableCell align="center">{project.name}</TableCell>
                                    <TableCell align="center">{project.startDate}</TableCell>
                                    <TableCell align="center">{project.endDate}</TableCell>
                                    <TableCell align="center">{project.participants}</TableCell>
                                    <TableCell align="center">{project.description}</TableCell>
                                </TableRow>
                            ))}
                        </TableBody>
                    </Table>
                </TableContainer>
            </Container>
        </Box>
    );
}

export default ProjectsPage;
