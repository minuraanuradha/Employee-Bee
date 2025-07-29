// Employee-Bee JavaScript Application

// Debug mode - should be controlled by environment
const debugMode = window.APP_DEBUG || false;

// Global debug function
function debugLog(message, level = 'log') {
    if (!debugMode) return;
    
    const validLevels = ['log', 'warn', 'error', 'info'];
    const logLevel = validLevels.includes(level) ? level : 'log';
    
    console[logLevel]('[Employee-Bee]', message);
}

// Application initialization
document.addEventListener('DOMContentLoaded', function() {
    debugLog('Employee-Bee application initialized', 'info');
    
    // Initialize UI components
    initializeComponents();
    
    // Set up event listeners
    setupEventListeners();
});

// Initialize UI components
function initializeComponents() {
    debugLog('Initializing UI components');
    
    // Mobile navigation toggle
    const mobileMenuButton = document.querySelector('[data-mobile-menu-toggle]');
    const mobileMenu = document.querySelector('[data-mobile-menu]');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            debugLog('Mobile menu toggled');
        });
    }
    
    // Dropdown menus
    const dropdownButtons = document.querySelectorAll('[data-dropdown-toggle]');
    dropdownButtons.forEach(button => {
        const targetId = button.getAttribute('data-dropdown-toggle');
        const dropdown = document.getElementById(targetId);
        
        if (dropdown) {
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdown.classList.toggle('hidden');
                debugLog(`Dropdown ${targetId} toggled`);
            });
        }
    });
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function() {
        const openDropdowns = document.querySelectorAll('[id$="-dropdown"]:not(.hidden)');
        openDropdowns.forEach(dropdown => {
            dropdown.classList.add('hidden');
        });
    });
}

// Set up global event listeners
function setupEventListeners() {
    debugLog('Setting up event listeners');
    
    // Form validation
    const forms = document.querySelectorAll('form[data-validate]');
    forms.forEach(form => {
        form.addEventListener('submit', validateForm);
    });
    
    // File upload handlers
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(input => {
        input.addEventListener('change', handleFileUpload);
    });
    
    // Search functionality
    const searchInputs = document.querySelectorAll('[data-search]');
    searchInputs.forEach(input => {
        input.addEventListener('input', debounce(handleSearch, 300));
    });
}

// Form validation function
function validateForm(event) {
    const form = event.target;
    const requiredFields = form.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            isValid = false;
            showFieldError(field, 'This field is required');
        } else {
            clearFieldError(field);
        }
    });
    
    // Email validation
    const emailFields = form.querySelectorAll('input[type="email"]');
    emailFields.forEach(field => {
        if (field.value && !isValidEmail(field.value)) {
            isValid = false;
            showFieldError(field, 'Please enter a valid email address');
        }
    });
    
    if (!isValid) {
        event.preventDefault();
        debugLog('Form validation failed', 'warn');
    } else {
        debugLog('Form validation passed', 'info');
    }
}

// File upload handler
function handleFileUpload(event) {
    const input = event.target;
    const file = input.files[0];
    
    if (!file) return;
    
    debugLog(`File selected: ${file.name} (${file.size} bytes)`);
    
    // Validate file size (10MB limit)
    const maxSize = 10 * 1024 * 1024;
    if (file.size > maxSize) {
        showFieldError(input, 'File size must be less than 10MB');
        input.value = '';
        return;
    }
    
    // Validate file type
    const allowedTypes = input.getAttribute('data-allowed-types');
    if (allowedTypes) {
        const types = allowedTypes.split(',').map(type => type.trim().toLowerCase());
        const fileExtension = file.name.split('.').pop().toLowerCase();
        
        if (!types.includes(fileExtension)) {
            showFieldError(input, `Only ${allowedTypes} files are allowed`);
            input.value = '';
            return;
        }
    }
    
    clearFieldError(input);
    
    // Show file preview for images
    if (file.type.startsWith('image/')) {
        showImagePreview(input, file);
    }
}

// Search handler with debouncing
function handleSearch(event) {
    const input = event.target;
    const query = input.value.trim();
    const searchType = input.getAttribute('data-search');
    
    debugLog(`Search: ${searchType} - "${query}"`);
    
    if (query.length < 2) {
        clearSearchResults(input);
        return;
    }
    
    // Perform search based on type
    switch (searchType) {
        case 'employees':
            searchEmployees(query, input);
            break;
        case 'companies':
            searchCompanies(query, input);
            break;
        default:
            debugLog(`Unknown search type: ${searchType}`, 'warn');
    }
}

// Utility functions
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function showFieldError(field, message) {
    clearFieldError(field);
    
    field.classList.add('border-red-500');
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'text-red-500 text-sm mt-1 field-error';
    errorDiv.textContent = message;
    
    field.parentNode.appendChild(errorDiv);
}

function clearFieldError(field) {
    field.classList.remove('border-red-500');
    
    const existingError = field.parentNode.querySelector('.field-error');
    if (existingError) {
        existingError.remove();
    }
}

function showImagePreview(input, file) {
    const reader = new FileReader();
    reader.onload = function(e) {
        let preview = input.parentNode.querySelector('.image-preview');
        
        if (!preview) {
            preview = document.createElement('img');
            preview.className = 'image-preview mt-2 max-w-xs max-h-48 rounded border';
            input.parentNode.appendChild(preview);
        }
        
        preview.src = e.target.result;
    };
    reader.readAsDataURL(file);
}

function clearSearchResults(input) {
    const resultsContainer = document.querySelector(`[data-search-results="${input.getAttribute('data-search')}"]`);
    if (resultsContainer) {
        resultsContainer.innerHTML = '';
    }
}

function searchEmployees(query, input) {
    // Implementation would depend on your backend API
    debugLog(`Searching employees for: ${query}`);
    // Example AJAX call would go here
}

function searchCompanies(query, input) {
    // Implementation would depend on your backend API
    debugLog(`Searching companies for: ${query}`);
    // Example AJAX call would go here
}

// Export functions for global use
window.EmployeeBee = {
    debugLog,
    showFieldError,
    clearFieldError,
    isValidEmail
};

