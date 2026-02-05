/**
 * Login Page Interactive Features
 * Handles password visibility toggle, form validation, and animations
 */

// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    initPasswordToggle();
    initFormValidation();
    initSocialButtons();
    initAnimations();
});

/**
 * Initialize password visibility toggle
 */
function initPasswordToggle() {
    const toggleButton = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    
    if (!toggleButton || !passwordInput) return;
    
    toggleButton.addEventListener('click', function() {
        // Toggle password visibility
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        // Toggle icon
        const eyeIcon = this.querySelector('.eye-icon');
        if (type === 'text') {
            eyeIcon.innerHTML = `
                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <line x1="1" y1="1" x2="23" y2="23" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            `;
        } else {
            eyeIcon.innerHTML = `
                <path d="M1 12S5 4 12 4s11 8 11 8-4 8-11 8S1 12 1 12z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            `;
        }
        
        // Add animation
        this.style.transform = 'scale(0.9)';
        setTimeout(() => {
            this.style.transform = 'scale(1)';
        }, 100);
    });
}

/**
 * Initialize form validation with real-time feedback
 */
function initFormValidation() {
    const form = document.querySelector('.login-form');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    
    if (!form) return;
    
    // Real-time validation
    usernameInput?.addEventListener('blur', function() {
        validateUsername(this);
    });
    
    passwordInput?.addEventListener('blur', function() {
        validatePassword(this);
    });
    
    // Form submission
    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        if (!validateUsername(usernameInput)) {
            isValid = false;
        }
        
        if (!validatePassword(passwordInput)) {
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
            showError('Please fill in all required fields correctly.');
        } else {
            // Add loading state to button
            const submitButton = form.querySelector('.btn-login');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.innerHTML = `
                    <svg class="spinner" viewBox="0 0 24 24" style="width: 20px; height: 20px; animation: spin 1s linear infinite;">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" opacity="0.25"/>
                        <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" opacity="0.75"/>
                    </svg>
                    <span>Signing in...</span>
                `;
            }
        }
    });
}

/**
 * Validate username input
 */
function validateUsername(input) {
    if (!input) return false;
    
    const value = input.value.trim();
    
    if (value.length === 0) {
        showInputError(input, 'Username is required');
        return false;
    }
    
    if (value.length < 3) {
        showInputError(input, 'Username must be at least 3 characters');
        return false;
    }
    
    clearInputError(input);
    return true;
}

/**
 * Validate password input
 */
function validatePassword(input) {
    if (!input) return false;
    
    const value = input.value;
    
    if (value.length === 0) {
        showInputError(input, 'Password is required');
        return false;
    }
    
    if (value.length < 6) {
        showInputError(input, 'Password must be at least 6 characters');
        return false;
    }
    
    clearInputError(input);
    return true;
}

/**
 * Show input-specific error
 */
function showInputError(input, message) {
    const wrapper = input.closest('.input-wrapper');
    if (!wrapper) return;
    
    // Remove existing error
    const existingError = wrapper.parentElement.querySelector('.input-error');
    if (existingError) {
        existingError.remove();
    }
    
    // Add error styling
    input.style.borderColor = '#ef4444';
    
    // Create error message
    const errorDiv = document.createElement('div');
    errorDiv.className = 'input-error';
    errorDiv.style.cssText = 'color: #fca5a5; font-size: 0.875rem; margin-top: 0.25rem;';
    errorDiv.textContent = message;
    
    wrapper.parentElement.appendChild(errorDiv);
}

/**
 * Clear input error
 */
function clearInputError(input) {
    const wrapper = input.closest('.input-wrapper');
    if (!wrapper) return;
    
    input.style.borderColor = '';
    
    const existingError = wrapper.parentElement.querySelector('.input-error');
    if (existingError) {
        existingError.remove();
    }
}

/**
 * Show general error message
 */
function showError(message) {
    // Check if error alert already exists
    let errorAlert = document.querySelector('.error-alert');
    
    if (!errorAlert) {
        errorAlert = document.createElement('div');
        errorAlert.className = 'error-alert';
        errorAlert.innerHTML = `
            <svg class="error-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                <path d="M12 8V12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <circle cx="12" cy="16" r="1" fill="currentColor"/>
            </svg>
            <span>${message}</span>
        `;
        
        const form = document.querySelector('.login-form');
        if (form) {
            form.parentElement.insertBefore(errorAlert, form);
        }
    } else {
        errorAlert.querySelector('span').textContent = message;
    }
}

/**
 * Initialize social login buttons
 */
function initSocialButtons() {
    const socialButtons = document.querySelectorAll('.social-btn');
    
    socialButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const provider = this.classList.contains('social-google') ? 'Google' : 'GitHub';
            
            // Add ripple effect
            createRipple(e, this);
            
            // Simulate social login (replace with actual implementation)
            setTimeout(() => {
                alert(`${provider} login is not yet implemented. This is a demo feature.`);
            }, 300);
        });
    });
}

/**
 * Create ripple effect on button click
 */
function createRipple(event, element) {
    const ripple = document.createElement('span');
    const rect = element.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = event.clientX - rect.left - size / 2;
    const y = event.clientY - rect.top - size / 2;
    
    ripple.style.cssText = `
        position: absolute;
        width: ${size}px;
        height: ${size}px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        left: ${x}px;
        top: ${y}px;
        pointer-events: none;
        transform: scale(0);
        animation: ripple 0.6s ease-out;
    `;
    
    element.style.position = 'relative';
    element.style.overflow = 'hidden';
    element.appendChild(ripple);
    
    setTimeout(() => ripple.remove(), 600);
}

/**
 * Initialize entrance animations
 */
function initAnimations() {
    // Add stagger animation to form elements
    const formGroups = document.querySelectorAll('.form-group');
    formGroups.forEach((group, index) => {
        group.style.opacity = '0';
        group.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            group.style.transition = 'all 0.5s ease-out';
            group.style.opacity = '1';
            group.style.transform = 'translateY(0)';
        }, 100 * index);
    });
}

// Add CSS for ripple animation
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
`;
document.head.appendChild(style);
