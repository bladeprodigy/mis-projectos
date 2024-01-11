import React from 'react';
import {Box, Button, Dialog, DialogActions, DialogContent, DialogTitle, TextField} from '@mui/material';

const NewProjectDialog = ({ open, onClose, onCreate }) => {
    // Function to handle the form submission
    const handleFormSubmit = (event) => {
        event.preventDefault();
        const formData = new FormData(event.currentTarget);
        // Pass the form data up to the parent component
        onCreate({
            name: formData.get('name'),
            startDate: formData.get('startDate'),
            endDate: formData.get('endDate'),
            participants: formData.get('participants'),
            description: formData.get('description'),
        });
    };

    return (
        <Dialog open={open} onClose={onClose}>
            <DialogTitle>Create New Project</DialogTitle>
            <DialogContent>
                <Box component="form" onSubmit={handleFormSubmit} noValidate sx={{ mt: 1 }}>
                    <TextField
                        required
                        fullWidth
                        id="name"
                        label="Project Name"
                        name="name"
                        margin="dense"
                    />
                    <TextField
                        required
                        fullWidth
                        id="startDate"
                        label="Start Date"
                        name="startDate"
                        type="date"
                        InputLabelProps={{ shrink: true }}
                        margin="dense"
                    />
                    <TextField
                        required
                        fullWidth
                        id="endDate"
                        label="End Date"
                        name="endDate"
                        type="date"
                        InputLabelProps={{ shrink: true }}
                        margin="dense"
                    />
                    <TextField
                        required
                        fullWidth
                        id="participants"
                        label="Participants"
                        name="participants"
                        margin="dense"
                    />
                    <TextField
                        required
                        fullWidth
                        id="description"
                        label="Description"
                        name="description"
                        multiline
                        rows={4}
                        margin="dense"
                    />
                    <DialogActions>
                        <Button onClick={onClose}>Cancel</Button>
                        <Button type="submit" variant="contained">Create</Button>
                    </DialogActions>
                </Box>
            </DialogContent>
        </Dialog>
    );
};

export default NewProjectDialog;