<main id="main-content" class="flex flex-col items-center justify-stretch text-center px-4 mt-8 mb-2 h-full w-full">
  <div class="w-full flex flex-col items-center justify-start text-center bg-black h-full">
    <h1 class="text-h2 text-white mb-2 font-bold ">
      Discover Companies 
    </h1>
        <p class="text-xs text-lightgray mb-4 max-w-lg mx-auto">
      Explore and connect with companies in various industries. Search for companies by name, industry, or location to find the perfect match for your career or business needs.
    </p>
    <!-- Search Bar -->
    <div class="mt-6 flex justify-center rounded-full bg-darkgray w-2/3 sm:w-2/5">
      <div class="flex justify-center items-center w-full max-w-lg rounded-full overflow-hidden">
        <input type="text" id="companySearch" placeholder="Search by company name, industry, or location" class="flex-1 px-4 py-2 text-p-regular focus:outline-none bg-darkgray text-white">
        <button id="searchButton" class="bg-orange rounded-full w-7 h-7 mr-1">
          🔍
        </button>
      </div>
    </div>
    <!-- Company Cards -->
    <div id="companyCardsContainer" class="bg-black overflow-y-scroll w-full flex flex-col items-center space-y-2 max-h-[45vh] mt-4">
      <!-- Company cards will be dynamically loaded here -->
    </div>
  </div>
</main>

<!-- Company Details Modal -->
<div id="companyModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
  <div class="bg-darkgray rounded-lg p-6 w-11/12 max-w-2xl max-h-[90vh] overflow-y-auto">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-h4 text-white">Company Details</h2>
      <button id="closeModal" class="text-white text-2xl">&times;</button>
    </div>
    <div id="companyModalContent">
      <!-- Company details will be loaded here -->
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Load all companies on page load
  loadCompanies();
  
  // Search button event
  document.getElementById('searchButton').addEventListener('click', function() {
    loadCompanies();
  });
  
  // Search input enter key event
  document.getElementById('companySearch').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
      loadCompanies();
    }
  });
  
  // Close modal event
  document.getElementById('closeModal').addEventListener('click', function() {
    document.getElementById('companyModal').classList.add('hidden');
  });
  
  // Close modal when clicking outside
  document.getElementById('companyModal').addEventListener('click', function(e) {
    if (e.target === this) {
      this.classList.add('hidden');
    }
  });
});

function loadCompanies() {
  const searchTerm = document.getElementById('companySearch').value;
  
  // Show loading state
  const container = document.getElementById('companyCardsContainer');
  container.innerHTML = '<div class="text-white py-4">Loading companies...</div>';
  
  // Fetch companies
  fetch(`/employee-bee/public/?path=companies-ajax${searchTerm ? `&search=${encodeURIComponent(searchTerm)}` : ''}`)
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        displayCompanies(data.companies);
      } else {
        container.innerHTML = '<div class="text-white py-4">Error loading companies</div>';
      }
    })
    .catch(error => {
      console.error('Error:', error);
      container.innerHTML = '<div class="text-white py-4">Error loading companies</div>';
    });
}

function displayCompanies(companies) {
  const container = document.getElementById('companyCardsContainer');
  
  if (companies.length === 0) {
    container.innerHTML = '<div class="text-white py-4">No companies found</div>';
    return;
  }
  
  let html = '';
  companies.forEach(company => {
    html += `
      <div class="flex justify-between items-center px-4 py-3 border border-orange rounded-xl w-full md:w-2/3">
        <div class="flex items-center space-x-3">
          ${company.logo_path ? 
            `<img src="/employee-bee/${company.logo_path}" alt="${company.company_name}" class="w-10 h-10 rounded object-contain">` : 
            `<div class="w-10 h-10 bg-orange rounded flex items-center justify-center text-white font-bold">${company.company_name.charAt(0)}</div>`
          }
          <div class="text-left">
            <h2 class="text-white text-h6">${company.company_name}</h2>
            <p class="text-p-regular text-gray-300">${company.industry || 'Industry not specified'}</p>
          </div>
        </div>
        <button class="btn-1 ml-1" onclick="showCompanyDetails(${company.id})">View Profile</button>
      </div>
    `;
  });
  
  container.innerHTML = html;
}

function showCompanyDetails(companyId) {
  // Show loading state in modal
  const modalContent = document.getElementById('companyModalContent');
  modalContent.innerHTML = '<div class="text-white py-4 text-center">Loading company details...</div>';
  document.getElementById('companyModal').classList.remove('hidden');
  
  // Fetch company details
  fetch(`/employee-bee/public/?path=company-details-ajax&company_id=${companyId}`)
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        displayCompanyDetails(data.company, data.stats);
      } else {
        modalContent.innerHTML = '<div class="text-white py-4 text-center">Error loading company details</div>';
      }
    })
    .catch(error => {
      console.error('Error:', error);
      modalContent.innerHTML = '<div class="text-white py-4 text-center">Error loading company details</div>';
    });
}

function displayCompanyDetails(company, stats) {
  const modalContent = document.getElementById('companyModalContent');
  
  modalContent.innerHTML = `
    <div class="flex flex-col md:flex-row items-start mb-4">
      ${company.logo_path ? 
        `<img src="/employee-bee/${company.logo_path}" alt="${company.company_name}" class="w-16 h-16 rounded object-contain mr-4">` : 
        `<div class="w-16 h-16 bg-orange rounded flex items-center justify-center text-white font-bold text-xl mr-4">${company.company_name.charAt(0)}</div>`
      }
      <div>
        <h3 class="text-h3 text-white mb-2">${company.company_name}</h3>
        <p class="text-p-regular text-gray-300">${company.industry || 'Industry not specified'}</p>
        <p class="text-p-regular text-gray-300">${company.location || 'Location not specified'}</p>
      </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
      <div class="bg-black/50 p-3 rounded">
        <p class="text-p-regular text-gray-400">Company Size</p>
        <p class="text-white">${company.company_size || 'Not specified'}</p>
      </div>
      <div class="bg-black/50 p-3 rounded">
        <p class="text-p-regular text-gray-400">Active Members</p>
        <p class="text-white">${stats.active_members || 0}</p>
      </div>
      <div class="bg-black/50 p-3 rounded">
        <p class="text-p-regular text-gray-400">Inactive Members</p>
        <p class="text-white">${stats.inactive_members || 0}</p>
      </div>
      <div class="bg-black/50 p-3 rounded">
        <p class="text-p-regular text-gray-400">Contact Person</p>
        <p class="text-white">${company.contact_person || 'Not specified'}</p>
      </div>
    </div>
    
    <div class="mb-4">
      <h4 class="text-h5 text-white mb-2">About Company</h4>
      <p class="text-p-regular text-gray-300">${company.description || 'No description available'}</p>
    </div>
    
    <div class="flex flex-wrap gap-2">
      ${company.website_url ? 
        `<a href="${company.website_url}" target="_blank" class="btn-2 text-sm">Website</a>` : ''}
      ${company.linkedin_url ? 
        `<a href="${company.linkedin_url}" target="_blank" class="btn-2 text-sm">LinkedIn</a>` : ''}
    </div>
  `;
}
</script>