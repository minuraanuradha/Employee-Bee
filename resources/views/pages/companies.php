<main id="main-content" class="flex flex-col items-center justify-stretch text-center px-4 mt-8 mb-2 h-full w-full">
  <div class="w-full flex flex-col items-center justify-start text-center h-full">
    <h1 class="text-h2 text-white mb-2 font-bold ">
      Discover Companies 
    </h1>
        <p class="text-xs text-lightgray mb-4 max-w-lg mx-auto">
      Explore and connect with companies in various industries. Search for companies by name, industry, or location to find the perfect match for your career or business needs.
    </p>
    <!-- Search Bar -->
    <div class="mt-2 flex justify-center rounded-full bg-black w-2/3 sm:w-2/5 border-darkgray border p-1 focus:border-orange">
      <div class="flex justify-center items-center w-full max-w-lg rounded-full overflow-hidden">
        <input type="text" id="companySearch" placeholder="Search by company name, industry, or location" class="flex-1 px-4 py-2 text-p-regular focus:outline-none bg-black text-white">
        <button id="searchButton" class="bg-orange/50 rounded-full w-7 h-7 mr-1">
          🔍
        </button>
      </div>
    </div>
    <!-- Company Cards -->
    <div id="companyCardsContainer" class=" overflow-y-scroll w-full flex flex-col items-center space-y-2 max-h-[45vh] mt-8  shadow-lg shadow-black">
      <!-- Company cards will be dynamically loaded here -->
    </div>
  </div>
</main>

<!-- Company Details Modal -->
<div id="companyModal" class="fixed inset-0 backdrop-blur-sm flex items-center justify-center z-50 hidden">
  <div class="bg-black/95 rounded-xl p-6 w-11/12 max-w-2xl max-h-[90vh] overflow-y-auto border border-orange/20 shadow-2xl shadow-orange/10">
    <div class="flex justify-between items-center mb-6 pb-2 border-b border-orange/10">
      <h2 class="text-h5 text-white font-light">Company Details</h2>
      <button id="closeModal" class="text-gray-400 hover:text-white text-2xl transition-colors duration-200">&times;</button>
    </div>
    <div id="companyModalContent" class="mt-2">
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
      <div class="flex justify-between items-center px-4 py-3 border border-orange/50 rounded-xl w-full md:w-2/3 bg-black/80">
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
        <button class="bg-orange/50 border-orange border p-1 px-6 rounded-lg text-white text-sm ml-1 hover:bg-orange" onclick="showCompanyDetails(${company.id})">View Profile</button>
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
    <!-- Company Header -->
    <div class="flex items-start mb-4">
      ${company.logo_path ?
        `<img src="/employee-bee/${company.logo_path}" alt="${company.company_name}" class="w-16 h-16 rounded-lg object-contain mr-4 border border-orange/20">` :
        `<div class="w-20 h-20 bg-gradient-to-r from-orange to-orange/80 rounded-lg flex items-center justify-center text-white font-bold text-xl mr-4">${company.company_name.charAt(0)}</div>`
      }
      <div class="">
        <h3 class="text-2xl font-semibold text-white mb-1">${company.company_name}</h3>
        <p class="text-gray-400 text-xs text-left">${company.industry || 'Industry not specified'}</p>
        <p class="text-gray-400 text-xs text-left">${company.location || 'Location not specified'}</p>
      </div>
    </div>

    <!-- Member Statistics -->
    <div class="mb-4">
      <div class="flex items-center gap-4 mb-3">
        <div class="flex items-center gap-2">
          <span class="px-2 py-0.5 bg-green-500/20 text-green-400 text-xs rounded-full border border-green-500/30">Active Members: ${stats.active_members || 0}</span>
        </div>
        <div class="flex items-center gap-2">
          <span class="px-2 py-0.5 bg-red-500/20 text-red-400 text-xs rounded-full border border-red-500/30">Inactive Members: ${stats.inactive_members || 0}</span>
        </div>
      </div>
    </div>

    <!-- Contact Information -->
    <div class="mb-4 space-y-3">
      <h4 class="text-white font-medium mb-3 text-left">Contact Information</h4>
      
      ${company.contact_person ? `
        <div class="flex items-center gap-3 text-gray-300 ml-4">
          <div class="w-4 h-4 flex items-center justify-center">
            <span class="text-orange">👤</span>
          </div>
          <span class="text-xs">${company.contact_person}</span>
        </div>
      ` : ''}

      ${company.phone_number ? `
        <div class="flex items-center gap-3 text-gray-300 ml-4">
          <div class="w-4 h-4 flex items-center justify-center">
            <span class="text-orange">📞</span>
          </div>
          <span class="text-xs">${company.phone_number}</span>
        </div>
      ` : ''}

      ${company.email_address ? `
        <div class="flex items-center gap-3 text-gray-300 ml-4">
          <div class="w-4 h-4 flex items-center justify-center">
            <span class="text-orange">✉️</span>
          </div>
          <span class="text-xs">${company.email_address}</span>
        </div>
      ` : ''}

      ${company.company_size ? `
        <div class="flex items-center gap-3 text-gray-300 ml-4">
          <div class="w-4 h-4 flex items-center justify-center">
            <span class="text-orange">🏢</span>
          </div>
          <span class="text-xs">${company.company_size}</span>
        </div>
      ` : ''}
    </div>

    <!-- About Section -->
    ${company.description ? `
      <div class="mb-6">
        <h4 class="text-white font-medium mb-3 text-left">About</h4>
        <p class="text-gray-300 text-xs leading-relaxed text-left ml-4">${company.description}</p>
      </div>
    ` : ''}

    <!-- Social Links -->
    <div class="flex gap-3">
      ${company.website_url ? `
        <a href="${company.website_url}" target="_blank" class="flex items-center gap-2 px-3 py-0.5 bg-orange/10 text-orange hover:bg-orange/20 rounded-lg text-sm transition-colors duration-200 border border-orange/20">
          <span class="text-xs">🌐</span>
          <span>Website</span>
        </a>
      ` : ''}
      
      ${company.linkedin_url ? `
        <a href="${company.linkedin_url}" target="_blank" class="flex items-center gap-2 px-3 py-0.5 bg-orange/10 text-orange hover:bg-orange/20 rounded-lg text-sm transition-colors duration-200 border border-orange/20">
          <span class="text-xs">💼</span>
          <span>LinkedIn</span>
        </a>
      ` : ''}
    </div>
  `;
}
</script>