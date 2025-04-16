document.addEventListener('DOMContentLoaded', function() {

    // ===== CLIENT FORM ===== //
    const addClientBtn = document.querySelector('.add-button'); 
    const clientPopup = document.getElementById('popupForm');
    const closeClientBtn = document.getElementById('closePopupBtn');
    const cancelClientBtn = document.getElementById('cancelFormBtn');
    const clientForm = document.getElementById('clientForm');

    // Check if elements exist before adding listeners
    if (addClientBtn && clientPopup) {
        addClientBtn.addEventListener('click', function() {
            clientPopup.style.display = 'flex';
            // Set default registration date
            const dateField = document.getElementById('clientRegDate');
            if (dateField) dateField.valueAsDate = new Date();
        });
    }

    if (closeClientBtn && clientPopup) {
        closeClientBtn.addEventListener('click', function() {
            clientPopup.style.display = 'none';
            if (clientForm) clientForm.reset(); // Reset form on close
        });
    }

    if (cancelClientBtn && clientPopup) {
        cancelClientBtn.addEventListener('click', function() {
            clientPopup.style.display = 'none';
            if (clientForm) clientForm.reset(); // Reset form on cancel
        });
    }

    // Close popup by clicking outside the form area
    if (clientPopup) {
        clientPopup.addEventListener('click', function(e) {
            if (e.target === clientPopup) {
                clientPopup.style.display = 'none';
                if (clientForm) clientForm.reset();
            }
        });
    }

    // Handle Client Form Submission (Allow default submission)
    if (clientForm) {
        clientForm.addEventListener('submit', function(e) {
            console.log('Client form submitted (standard behavior)');
        });
    }

    // ===== PORTFOLIO FORM ===== //
    const addPortfolioBtn = document.getElementById('addPortfolioBtn');
    const portfolioPopup = document.getElementById('portfolioPopupForm');
    const closePortfolioBtn = document.getElementById('closePortfolioPopupBtn');
    const cancelPortfolioBtn = document.getElementById('cancelPortfolioBtn');
    const portfolioForm = document.getElementById('portfolioForm');

    if (addPortfolioBtn && portfolioPopup) {
        addPortfolioBtn.addEventListener('click', function() {
            portfolioPopup.style.display = 'flex';
        });
    }

    if (closePortfolioBtn && portfolioPopup) {
        closePortfolioBtn.addEventListener('click', function() {
            portfolioPopup.style.display = 'none';
            if (portfolioForm) portfolioForm.reset();
        });
    }

    if (cancelPortfolioBtn && portfolioPopup) {
        cancelPortfolioBtn.addEventListener('click', function() {
            portfolioPopup.style.display = 'none';
            if (portfolioForm) portfolioForm.reset();
        });
    }

    if (portfolioPopup) {
        portfolioPopup.addEventListener('click', function(e) {
            if (e.target === portfolioPopup) {
                portfolioPopup.style.display = 'none';
                if (portfolioForm) portfolioForm.reset();
            }
        });
    }

    // Handle Portfolio Form Submission (Allow default submission)
    if (portfolioForm) {
        portfolioForm.addEventListener('submit', function(e) {
            console.log('Portfolio form submitted (standard behavior)');
        });
    }

    // ===== PORTFOLIO INVESTMENT FORM ===== //
    const addPortfolioInvestmentBtn = document.getElementById('addPortfolioInvestmentBtn');
    const portfolioInvestmentPopup = document.getElementById('portfolioInvestmentPopupForm'); 
    const closePortfolioInvestmentBtn = document.getElementById('closePortfolioInvestmentPopupBtn'); 
    const cancelPortfolioInvestmentBtn = document.getElementById('cancelPortfolioInvestmentBtn');
    const portfolioInvestmentForm = document.getElementById('portfolioInvestmentForm'); 

    if (addPortfolioInvestmentBtn && portfolioInvestmentPopup) {
        addPortfolioInvestmentBtn.addEventListener('click', function() {
            portfolioInvestmentPopup.style.display = 'flex';
        });
    }

    if (closePortfolioInvestmentBtn && portfolioInvestmentPopup) {
        closePortfolioInvestmentBtn.addEventListener('click', function() {
            portfolioInvestmentPopup.style.display = 'none';
            if (portfolioInvestmentForm) portfolioInvestmentForm.reset();
        });
    }

    if (cancelPortfolioInvestmentBtn && portfolioInvestmentPopup) {
        cancelPortfolioInvestmentBtn.addEventListener('click', function() {
            portfolioInvestmentPopup.style.display = 'none';
            if (portfolioInvestmentForm) portfolioInvestmentForm.reset();
        });
    }

    if (portfolioInvestmentPopup) {
        portfolioInvestmentPopup.addEventListener('click', function(e) {
            if (e.target === portfolioInvestmentPopup) {
                portfolioInvestmentPopup.style.display = 'none';
                if (portfolioInvestmentForm) portfolioInvestmentForm.reset();
            }
        });
    }

    // Handle Portfolio Investment Form Submission (Allow default submission)
    if (portfolioInvestmentForm) {
        portfolioInvestmentForm.addEventListener('submit', function(e) {
            console.log('Portfolio Investment form submitted (standard behavior)');
        });
    }


    // ===== INVESTMENT FORM ===== //
    const addInvestBtn = document.getElementById('addInvestmentBtn'); 
    const investPopup = document.getElementById('investmentPopupForm'); 
    const closeInvestBtn = document.getElementById('closeInvestmentPopupBtn'); 
    const cancelInvestBtn = document.getElementById('cancelInvestmentFormBtn'); 
    const investForm = document.getElementById('investmentForm'); 

    if (addInvestBtn && investPopup) {
        addInvestBtn.addEventListener('click', function() {
            investPopup.style.display = 'flex';
        });
    }

    if (closeInvestBtn && investPopup) {
        closeInvestBtn.addEventListener('click', function() {
            investPopup.style.display = 'none';
            if (investForm) investForm.reset();
        });
    }

    if (cancelInvestBtn && investPopup) {
        cancelInvestBtn.addEventListener('click', function() {
            investPopup.style.display = 'none';
            if (investForm) investForm.reset();
        });
    }
     if (investPopup) {
        investPopup.addEventListener('click', function(e) {
            if (e.target === investPopup) {
                investPopup.style.display = 'none';
                if (investForm) investForm.reset();
            }
        });
    }

    // Handle Investment Form Submission 
    if (investForm) {
        investForm.addEventListener('submit', function(e) {
             console.log('Investment form submitted (standard behavior)');
        });
    }

});
