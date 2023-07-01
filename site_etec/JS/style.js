class MobileNavbar {
    constructor(mobileMenu, navbarpp, navLinks) {
      this.mobileMenu = document.querySelector(mobileMenu);
      this.navbarpp = document.querySelector(navbarpp);
      this.navLinks = document.querySelectorAll(navLinks);
      this.activeClass = "active";

      this.handleCLick = this.handleCLick.bind(this);
    }
    animateLinks()
    {
        this.navLinks.forEach((link, index) =>
        { 
            link.style.animation ? 
            (link.style.animation = "") : 
            (link.style.animation = `navLinkFade 0.5s ease orwards 0.3s ${index / 7 + 0.3}` );
            
        });
    }
    handleCLick()
    {
        this.animateLinks();
        this.navbarpp.classList.toggle(this.activeClass);
    }
    addClickEvent() 
    {
      this.mobileMenu.addEventListener("click", this.handleCLick);
    }
  
    init() 
    {
      if (this.mobileMenu) 
      {
        this.addClickEvent();
      }
      return this;
    }
  }
  
//   var mobileNavbar = new MobileNavbar
//   (
//     ".mobile-menu",
//     ".navbarpp",
//     ".navbarpp li",
//   );
//   mobileNavbar.init();
  