// EditProjectDialog.js
import React from 'react';
import {
    Dialog, DialogTitle, DialogContent, DialogActions,
    Button, TextField, Box
} from '@mui/material';

const EditProjectDialog = ({ open, onClose, project, onSave }) => {
    const handleSubmit = (event) => {
        event.preventDefault();
        const formData = new FormData(event.currentTarget);
        onSave({
            name: formData.get('name'),
            startDate: formData.get('startDate'),
            endDate: formData.get('endDate'),
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
                        id="startDate"
                        label="Start Date"
                        type="date"
                        fullWidth
                        InputLabelProps={{ shrink: true }}
                        defaultValue={project.startDate}
                        name="startDate"
                    />
                    <TextField
                        margin="dense"
                        id="endDate"
                        label="End Date"
                        type="date"
                        fullWidth
                        InputLabelProps={{ shrink: true }}
                        defaultValue={project.endDate}
                        name="endDate"
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