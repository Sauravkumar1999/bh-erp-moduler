class Footer {
    constructor(content) {
      this.content = content;
      this.element = document.createElement('footer');
      this.element.innerHTML = `<p>${this.content}</p>`;
      this.element.classList.add('footer');
    }
  
    render(parentElement) {
      parentElement.appendChild(this.element);
    }
  }
  

  const footerContent = ``;
  const footer = new Footer(footerContent);
  const footerContainer = document.getElementById('footerContainer');
  footer.render(footerContainer);
  