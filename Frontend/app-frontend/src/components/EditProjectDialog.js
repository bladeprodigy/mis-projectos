import React from 'react';
import {Box, Button, Dialog, DialogActions, DialogContent, DialogTitle, TextField} from '@mui/material';

const EditProjectDialog = ({ open, onClose, project, onSave }) => {
    const handleSubmit = (event) => {
        event.preventDefault();
        const formData = new FormData(event.currentTarget);
        onSave({
            name: formData.get('name'),
            plannedEndDate: formData.get('plannedEndDate'),
            participants: formData.get('participants'),
            description: formData.get('description'),
        });
    };

    return (
        <Dialog open={open} onClose={onClose} maxWidth="md" fullWidth>
            <DialogTitle>Edit Project</DialogTitle>
            <Box component="form" onSubmit={handleSubmit} noValidate sx={{ mt: 1 }}>
                <DialogContent>
                    <TextField
                        margin="dense"
                        id="name"
                        label="Project Name"
                        type="text"
                        fullWidth
                        defaultValue={project.name}
                        name="name"
                    />
                    <TextField
                        margin="dense"
                        id="endDate"
                        label="Planned End Date"
                        type="date"
                        fullWidth
                        InputLabelProps={{ shrink: true }}
                        defaultValue={project.plannedEndDate}
                        name="plannedEndDate"
                    />
                    <TextField
                        margin="dense"
                        id="participants"
                        label="Participants"
                        type="text"
                        fullWidth
                        defaultValue={project.participants}
                        name="participants"
                    />
                    <TextField
                        margin="dense"
                        id="description"
                        label="Description"
                        type="text"
                        fullWidth
                        multiline
                        rows={4}
                        defaultValue={project.description}
                        name="description"
                    />
                </DialogContent>
                <DialogActions>
                    <Button onClick={onClose}>Cancel</Button>
                    <Button type="submit" variant="contained">Save</Button>
                </DialogActions>
            </Box>
        </Dialog>
    );
};

export default EditProjectDialog;