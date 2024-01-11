import React, {useState} from 'react';
import {useNavigate, useParams} from 'react-router-dom';
import {
    Box,
    Button,
    Card,
    CardContent,
    Dialog,
    DialogActions,
    DialogContent,
    DialogContentText,
    DialogTitle,
    Typography
} from '@mui/material';
import EditProjectDialog from "./EditProjectDialog";

// Assuming you have a function to fetch project details (to be implemented)
const fetchProjectDetails = (projectId) => {
    // This is a placeholder function. You would fetch data from a backend or context.
    console.log(`Fetching details for project ID: ${projectId}`);
    return {
        id: projectId,
        name: 'Project X',
        creationDate: '2024-09-01',
        plannedEndDate: '2024-09-02',
        participants: 'Tom, Andy, Cindy',
        description: 'A very secret project',
        status: 'Ongoing' // or 'Finished'
    };
};

const ProjectDetails = () => {
    let { projectId } = useParams();
    const navigate = useNavigate();

    // Simulate fetching project details
    const project = fetchProjectDetails(projectId);
    const [editDialogOpen, setEditDialogOpen] = useState(false);
    const [openFinishDialog, setOpenFinishDialog] = useState(false);
    const [openDeleteDialog, setOpenDeleteDialog] = useState(false);

    const handleEdit = () => {
        setEditDialogOpen(true);
    };

    const handleSaveEdit = (updatedProjectData) => {
        console.log(updatedProjectData);
        setEditDialogOpen(false);
        // Here you would typically send the updated data to the server via an API call
    };

    const handleOpenFinishDialog = () => {
        setOpenFinishDialog(true);
    };

    const handleCloseFinishDialog = () => {
        setOpenFinishDialog(false);
    };

    const handleFinishProject = () => {
        // Implement the finish project logic here
        console.log('Project finished');
        handleCloseFinishDialog();
        navigate('/projects');
    };

    const handleOpenDeleteDialog = () => {
        setOpenDeleteDialog(true);
    };

    const handleCloseDeleteDialog = () => {
        setOpenDeleteDialog(false);
    };

    const handleDeleteProject = () => {
        // Implement the delete project logic here
        console.log('Project deleted');
        handleCloseDeleteDialog();
        navigate('/projects');
    };

    return (
        <Box sx={{ display: 'flex', flexDirection: 'column', minHeight: '100vh', alignItems: 'center', justifyContent: 'center', gap: 2 }}>
            {project.status === 'Ongoing' && (
                <Box sx={{ display: 'flex', justifyContent: 'center', gap: 2, mb: 2 }}>
                    <Button variant="contained" color="primary" onClick={handleEdit}>Edit</Button>
                    <Button variant="contained" color="success" onClick={handleOpenFinishDialog}>Finish</Button>
                    <Button variant="contained" color="error" onClick={handleOpenDeleteDialog}>Delete</Button>
                </Box>
            )}
            <Card sx={{ minWidth: '80%', mb: 4 }}>
                <CardContent>
                    <Typography variant="h4" component="div" gutterBottom>
                        {project.name}
                    </Typography>
                    <Typography variant="subtitle1" gutterBottom><strong>Creation Date:</strong> {project.creationDate}</Typography>
                    <Typography variant="subtitle1" gutterBottom><strong>Planned End Date:</strong> {project.plannedEndDate}</Typography>
                    <Typography variant="subtitle1" gutterBottom><strong>Participants:</strong> {project.participants}</Typography>
                    <Typography variant="subtitle1" gutterBottom><strong>Description:</strong> {project.description}</Typography>
                    <Typography variant="subtitle1" gutterBottom><strong>Status:</strong> {project.status}</Typography>
                </CardContent>
            </Card>
            <EditProjectDialog
                open={editDialogOpen}
                onClose={() => setEditDialogOpen(false)}
                project={project}
                onSave={handleSaveEdit}
            />
            <Dialog
                open={openFinishDialog}
                onClose={handleCloseFinishDialog}
                aria-labelledby="finish-dialog-title"
                aria-describedby="finish-dialog-description"
            >
                <DialogTitle id="finish-dialog-title">{"Finish Project?"}</DialogTitle>
                <DialogContent>
                    <DialogContentText id="finish-dialog-description">
                        Are you sure you want to mark this project as finished?
                    </DialogContentText>
                </DialogContent>
                <DialogActions>
                    <Button onClick={handleCloseFinishDialog} color="primary">
                        Cancel
                    </Button>
                    <Button onClick={handleFinishProject} color="primary" autoFocus>
                        Finish
                    </Button>
                </DialogActions>
            </Dialog>
            <Dialog
                open={openDeleteDialog}
                onClose={handleCloseDeleteDialog}
                aria-labelledby="delete-dialog-title"
                aria-describedby="delete-dialog-description"
            >
                <DialogTitle id="delete-dialog-title">{"Delete Project?"}</DialogTitle>
                <DialogContent>
                    <DialogContentText id="delete-dialog-description">
                        Are you sure you want to delete this project? This action cannot be undone.
                    </DialogContentText>
                </DialogContent>
                <DialogActions>
                    <Button onClick={handleCloseDeleteDialog} color="primary">
                        Cancel
                    </Button>
                    <Button onClick={handleDeleteProject} color="primary" autoFocus>
                        Delete
                    </Button>
                </DialogActions>
            </Dialog>
        </Box>
    );
};

export default ProjectDetails;
