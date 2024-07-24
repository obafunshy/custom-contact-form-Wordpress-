(function() {
    // Ensure React and ReactDOM are loaded
    var e = React.createElement;
    
    // Define the SimpleContactForm component as a functional component
    function SimpleContactForm() {
        const [formData, setFormData] = React.useState({
            name: '',
            email: '',
            phone: '',
            message: ''
        });

        const [responseMessage, setResponseMessage] = React.useState('');

        // Handle input change
        function handleChange(e) {
            const name = e.target.name;
            const value = e.target.value;

            setFormData(prevState => ({
                ...prevState,
                [name]: value
            }));
        }

        // Handle form submission
        function handleSubmit(e) {
            e.preventDefault();

            fetch(simpleContactFormSettings.restURL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-WP-Nonce': simpleContactFormSettings.nonce
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                setResponseMessage(data);
            })
            .catch(error => {
                console.error('Error:', error);
                setResponseMessage('An error occurred.');
            });
        }

        return e('div', { className: 'simple-contact-form' },
            e('h1', null, 'Send us an email'),
            e('p', null, 'Please fill the below form'),
            e('form', { onSubmit: handleSubmit },
                e('div', { className: 'form-group mb-2' },
                    e('input', {
                        type: 'text',
                        name: 'name',
                        className: 'form-control',
                        placeholder: 'Name',
                        value: formData.name,
                        onChange: handleChange
                    })
                ),
                e('div', { className: 'form-group mb-2' },
                    e('input', {
                        type: 'email',
                        name: 'email',
                        className: 'form-control',
                        placeholder: 'Email',
                        value: formData.email,
                        onChange: handleChange
                    })
                ),
                e('div', { className: 'form-group mb-2' },
                    e('input', {
                        type: 'tel',
                        name: 'phone',
                        className: 'form-control',
                        placeholder: 'Phone',
                        value: formData.phone,
                        onChange: handleChange
                    })
                ),
                e('div', { className: 'form-group mb-2' },
                    e('textarea', {
                        name: 'message',
                        className: 'form-control',
                        placeholder: 'Type your message',
                        value: formData.message,
                        onChange: handleChange
                    })
                ),
                e('div', { className: 'form-group mb-2' },
                    e('button', {
                        type: 'submit',
                        className: 'btn btn-success btn-block w-100'
                    }, 'Send Message')
                )
            ),
            responseMessage && e('p', null, responseMessage)
        );
    }

    // Render the SimpleContactForm component
    document.addEventListener('DOMContentLoaded', function() {
        var root = document.getElementById('simple-contact-form-root');
        if (root) {
            ReactDOM.render(e(SimpleContactForm), root);
        }
    });
})();
