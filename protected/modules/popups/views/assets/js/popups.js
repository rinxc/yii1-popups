(function() {
    'use strict';
    if(window.Popups === undefined){
        class Popups {
            constructor(opts) {
                this.defaults = {
                    id_popups : 0,
                    title: '',
                    content: '',
                    show: 0,
                    allow_count:0,
                    countOpenUrl:'',
                    btnCloseText: 'X',
                    cssStyleID:'main',
                    cssStyleURL:'css/popups.css',
                    cssAnimID:'unfolding',
                    cssAnimURL:'css/animation/unfolding.css',
                    btnOpenClass:'popups-btn-open',
                    btnCloseClass:'popups-btn-close'
                },
                opts = opts || {},
                this.opts = this.extend(this.defaults, opts),
                this.id_el_popups = 'popups' + this.opts.id_popups;
                this.init();
            }

            init() {
                this.loadCSS('popups-style-' + this.opts.cssStyleID, this.opts.cssStyleURL);
                this.loadCSS('popups-animation-' + this.opts.cssAnimID, this.opts.cssAnimURL);
                
                this.setPopupHTMLBody();
                this.bindOpenPopupEvent();
                this.bindClosePopupEvent();

                if(this.opts.show !== 0){
                    this.openPopup();
                }
            }
            
            setSettings(opts){
                if(opts.title !== undefined) this.el.querySelector('.popups-title').innerHTML = opts.title;
                if(opts.content !== undefined) this.el.querySelector('.popups-content').innerHTML = opts.content;
                if(opts.cssAnimID !== undefined && opts.cssAnimURL !== undefined){
                    this.el.classList.remove(this.opts.cssAnimID);
                    this.loadCSS('popups-animation-' + opts.cssAnimID, opts.cssAnimURL);
                }
                this.opts = this.extend(this.opts, opts);
            }

            bindOpenPopupEvent() {
                document.querySelectorAll('.' + this.opts.btnOpenClass).forEach(el => el.addEventListener('click', this));
            }

            openPopup(){
                let el_body = document.getElementsByTagName('body')[0];
                el_body.classList.add('popups-active');
                this.el.classList.remove('out');
                this.el.classList.add(this.opts.cssAnimID);

                if(this.opts.allow_count !== 0){
                    this.countPopup();
                }
            }

            bindClosePopupEvent() {
                document.querySelectorAll('.' + this.opts.btnCloseClass + ', .popups-background').forEach(el => el.addEventListener('click', this));
            }

            closePopup(){
                this.el.classList.add('out');
                let el_body = document.getElementsByTagName('body')[0];
                el_body.classList.remove('popups-active');
            }

            loadCSS(id, src) {
                return new Promise(function (resolve, reject) {
                    if(document.getElementById(id)) return true;
                    let link = document.createElement('link');
                    link.id = id;
                    link.href = src;
                    link.rel = 'stylesheet';
                    link.onload = () => resolve(link);
                    document.head.append(link);
                });
            }

            setPopupHTMLBody() {
                let el_body = document.getElementsByTagName('body')[0];
                el_body.appendChild(this.createElm({'tag':'div', 'id':this.id_el_popups, 'cls':'popups'}));

                this.el = document.getElementById(this.id_el_popups);

                this.el.appendChild(this.createElm({'tag':'div', 'cls':'popups-background'}));

                this.el.querySelector('.popups-background').appendChild(this.createElm({'tag':'div', 'cls':'popups-container'})); 
                this.el.querySelector('.popups-container').appendChild(this.createElm({'tag':'button', 'type':'button', 'cls':this.opts.btnCloseClass, 'textContent': this.opts.btnCloseText}));
                this.el.querySelector('.popups-container').appendChild(this.createElm({'tag':'h2', 'cls':'popups-title', 'innerHTML':this.opts.title}));
                this.el.querySelector('.popups-container').appendChild(this.createElm({'tag':'div', 'cls':'popups-content', 'innerHTML':this.opts.content}));
            }

            createElm(opts){
                let el = document.createElement(opts.tag);
                if(opts.id !== undefined) el.setAttribute('id', opts.id);
                if(opts.cls !== undefined) el.setAttribute('class', opts.cls);
                if(opts.type !== undefined) el.setAttribute('type', opts.type);
                if(opts.textContent !== undefined) el.textContent = opts.textContent;
                if(opts.innerHTML !== undefined) el.innerHTML = opts.innerHTML;
                return el;
            }

            handleEvent(event) {
                if(event.target.classList.contains(this.opts.btnOpenClass)){
                    this.openPopup();
                }
                if(event.target.classList.contains(this.opts.btnCloseClass) || 
                event.target.classList.contains('popups-background')){
                    this.closePopup();
                }
            
            }
            
            async countPopup(){
                let response = await fetch(this.opts.countOpenUrl);
                if(response.statusText != 'OK') console.log(response);
            }

            extend(obj1, obj2) {
                var obj = {};
                for (var key in obj1) {
                    obj[key] = obj2[key] === undefined ? obj1[key] : obj2[key];
                }
                return obj;
            }
        }
        window.Popups = Popups;
    }
})();