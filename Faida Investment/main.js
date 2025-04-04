document.addEventListener('DOMContentLoaded', function() {

    // ===== CLIENT FORM ===== //
    const addClientBtn = document.querySelector('.add-button');
    const clientPopup = document.getElementById('popupForm');
    const closeClientBtn = document.getElementById('closePopupBtn');
    const cancelClientBtn = document.getElementById('cancelFormBtn');
    const clientForm = document.getElementById('clientForm');
    
    if (addClientBtn && clientPopup) {
        
        addClientBtn.addEventListener('click', function() {
            clientPopup.style.display = 'flex';
            const dateField = document.getElementById('clientRegDate');
            if (dateField) dateField.valueAsDate = new Date();
        });
        
        if (closeClientBtn) {
            closeClientBtn.addEventListener('click', function() {
                clientPopup.style.display = 'none';
                if (clientForm) clientForm.reset();
            });
        }
        
        if (cancelClientBtn) {
            cancelClientBtn.addEventListener('click', function() {
                clientPopup.style.display = 'none';
                if (clientForm) clientForm.reset();
            });
        }
        
        clientPopup.addEventListener('click', function(e) {
            if (e.target === clientPopup) {
                clientPopup.style.display = 'none';
                if (clientForm) clientForm.reset();
            }
        });
        
        if (clientForm) {
            clientForm.addEventListener('submit', function(e) {
                e.preventDefault();
                clientPopup.style.display = 'none';
                clientForm.reset();
            });
        }
    }

    // ===== PORTFOLIO FORM ===== //
    const addPortfolioBtn = document.getElementById('addPortfolioBtn');
    const portfolioPopup = document.getElementById('portfolioPopupForm');
    
    if (addPortfolioBtn && portfolioPopup) {
        
        addPortfolioBtn.addEventListener('click', function() {
            portfolioPopup.style.display = 'flex';
        });
        
        const closePortfolioBtn = document.getElementById('closePortfolioPopupBtn');
        const cancelPortfolioBtn = document.getElementById('cancelPortfolioBtn');
        const portfolioForm = document.getElementById('portfolioForm');
        
        if (closePortfolioBtn) {
            closePortfolioBtn.addEventListener('click', function() {
                portfolioPopup.style.display = 'none';
                if (portfolioForm) portfolioForm.reset();
            });
        }
        
        if (cancelPortfolioBtn) {
            cancelPortfolioBtn.addEventListener('click', function() {
                portfolioPopup.style.display = 'none';
                if (portfolioForm) portfolioForm.reset();
            });
        }
        
        portfolioPopup.addEventListener('click', function(e) {
            if (e.target === portfolioPopup) {
                portfolioPopup.style.display = 'none';
                if (portfolioForm) portfolioForm.reset();
            }
        });
        
        if (portfolioForm) {
            portfolioForm.addEventListener('submit', function(e) {
                e.preventDefault();
                portfolioPopup.style.display = 'none';
                portfolioForm.reset();
            });
        }
    }

    // ===== PORTFOLIO INVESTMENT FORM ===== //
    const addInvestmentBtn = document.getElementById('addPortfolioInvestmentBtn');
    const investmentPopup = document.getElementById('portfolioInvestmentPopupForm');
    
    if (addInvestmentBtn && investmentPopup) {
        
        addInvestmentBtn.addEventListener('click', function() {
            investmentPopup.style.display = 'flex';
        });
        
        const closeInvestmentBtn = document.getElementById('closePortfolioInvestmentPopupBtn');
        const cancelInvestmentBtn = document.getElementById('cancelPortfolioInvestmentBtn');
        const investmentForm = document.getElementById('portfolioInvestmentForm');
        
        if (closeInvestmentBtn) {
            closeInvestmentBtn.addEventListener('click', function() {
                investmentPopup.style.display = 'none';
                if (investmentForm) investmentForm.reset();
            });
        }
        
        if (cancelInvestmentBtn) {
            cancelInvestmentBtn.addEventListener('click', function() {
                investmentPopup.style.display = 'none';
                if (investmentForm) investmentForm.reset();
            });
        }
        
        investmentPopup.addEventListener('click', function(e) {
            if (e.target === investmentPopup) {
                investmentPopup.style.display = 'none';
                if (investmentForm) investmentForm.reset();
            }
        });
        
        if (investmentForm) {
            investmentForm.addEventListener('submit', function(e) {
                e.preventDefault();
                investmentPopup.style.display = 'none';
                investmentForm.reset();
            });
        }
    }
});
