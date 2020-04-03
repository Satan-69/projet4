class DomManipulation
{
    constructor()
    {
        this.links = document.getElementsByClassName('nav-item');
    }

    active = () =>
    {
        for ( let i=0; i<this.links.length; i++)
        {
            this.links[i].addEventListener('click', function()
            {
                var current = document.getElementsByClassName("active");
                current[0].className = current[0].className.replace(" active", "");
                this.className += " active";
            })
        }
    } 
}

const domManipulation = new DomManipulation;
domManipulation.active();