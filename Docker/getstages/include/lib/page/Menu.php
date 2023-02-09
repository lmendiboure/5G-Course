<?php

class Menu 
{
    private $cookieName;
    private $cookieTime;
    private $lockEtat;
    private $listOnglet;
    
    public function __construct()
    {
        $this->listOnglet = array();
        
        $this->cookieName = 'menu_lock';
        $this->cookieTime = 61*24*3600;
        if(!isset($_COOKIE[$this->cookieName]))
        {
            setcookie($this->cookieName, '0', time() + $this->cookieTime, null, null, false, false);
            $this->lockEtat = 0;
        }
        else
        {
            $this->lockEtat = $_COOKIE[$this->cookieName];
        }
    }
    
    public function isReduit()
    {
        return ($this->lockEtat == 2);
    }
    
    public function addOnglet($onglet)
    {
        array_push($this->listOnglet, $onglet);
    }
    
    public function afficher()
    {
        echo '<nav>';
        
        $this->afficherOnglet();
        $this->afficherLockButton();
        
        echo '</nav>';
    }
    
    private function afficherOnglet()
    {
        for($i = 0; $i < count($this->listOnglet); $i++)
        {
            $onglet = $this->listOnglet[$i];
            $this->listOnglet[$i]->afficher();
        }
    }
    
    private function afficherLockButton()
    {
        $request_uri = preg_replace('/[\&\?]lock=(droite|gauche)/', '', $_SERVER['REQUEST_URI']);
        
        if(preg_match('/\?/', $request_uri))
            $request_uri .= '&';
        else
            $request_uri .= '?';
        
        echo '<span class="bottom">';
            echo '<a id="icon_droite" ';
            if($this->lockEtat == 1) echo 'class="actif" ';
            echo 'href="javascript:menu.right(0)" title="Développer"><span>Développer</span></a>';
            
            echo '<a id="icon_gauche" ';
            if($this->lockEtat == 2) echo 'class="actif" ';
            echo 'href="javascript:menu.left(0)" title="Réduire"><span>Réduire</span></a>';
        echo '</span>';
    }
    
    public function appliquerScript()
    {
        ?>
        <script type="text/javascript">
            function setCookie(sName, sValue) 
            {
                var today = new Date(), expires = new Date();
                expires.setTime(today.getTime() + (<?php echo $this->cookieTime; ?>*1000));
                document.cookie = sName + "=" + encodeURIComponent(sValue) + ";expires=" + expires.toGMTString();
            }
            
            function getCookie(sName)
            {
                var oRegex = new RegExp("(?:; )?" + sName + "=([^;]*);?");
                
                if (oRegex.test(document.cookie)) 
                {
                    return decodeURIComponent(RegExp["$1"]);
                } 
                else 
                {
                    return null;
                }
            }
            
            function Menu()
            {
                this.cookieName = "<?php echo $this->cookieName; ?>";
                this.etatMenu = getCookie(this.cookieName);
                
                this.elemBody = document.querySelector("body");
                this.elemMenu = this.elemBody.querySelector("nav");
                this.elemLinkDroite = document.getElementById("icon_droite");
                this.elemLinkGauche = document.getElementById("icon_gauche");
                
                if(this.etatMenu == null)
                    this.setEtatMenu(0);
                
                if(this.etatMenu == 0)
                    this.modeDynamic(0);
                else
                {
                    if(this.etatMenu == 1)
                        this.elemLinkDroite.setAttribute("class", "actif");
                    if(this.etatMenu == 2)
                        this.elemLinkGauche.setAttribute("class", "actif");
                }
            }
            
            Menu.prototype.setEtatMenu = function(etat)
            {
                this.etatMenu = etat;
                setCookie(this.cookieName, etat);
            };
            
            Menu.prototype.modeDynamic = function()
            {
                this.decrease();
                
                this.elemMenu.addEventListener("mouseenter", this.expand);
                this.elemMenu.addEventListener("mouseleave", this.decrease);
            };
            
            Menu.prototype.modeStatic = function()
            {
                this.elemMenu.removeEventListener("mouseenter", this.expand);
                this.elemMenu.removeEventListener("mouseleave", this.decrease);
            };
            
            Menu.prototype.right = function() {this.changeEtatMenu(1);};
            Menu.prototype.left = function() {this.changeEtatMenu(2);};
            
            Menu.prototype.changeEtatMenu = function(newState)
            {
                if(this.etatMenu == newState)
                {
                    this.modeDynamic();
                    this.setEtatMenu(0);
                    
                    this.elemLinkDroite.removeAttribute("class");
                    this.elemLinkGauche.removeAttribute("class");
                }
                else
                {
                    if(this.etatMenu == 0)
                        this.modeStatic();
                    
                    if(newState == 1)
                    {
                        this.expand(null);
                        this.elemLinkGauche.removeAttribute("class");
                        this.elemLinkDroite.setAttribute("class", "actif");
                    }
                    else if(newState == 2)
                    {
                        this.decrease(null);
                        this.elemLinkDroite.removeAttribute("class");
                        this.elemLinkGauche.setAttribute("class", "actif");
                    }
                    
                    this.setEtatMenu(newState);
                }
                
                
            };
            
            Menu.prototype.expand = function(e)
            {
                var elemBody;
                
                if(e == null)
                    elemBody = this.elemBody;
                else
                    elemBody = document.querySelector("body");
                
                elemBody.removeAttribute("class");
                
            };
            
            Menu.prototype.decrease = function(e)
            {
                var elemBody;
                
                if(e == null)
                    elemBody = this.elemBody;
                else
                    elemBody = document.querySelector("body");
                    
                elemBody.setAttribute("class", "reduit");
            };
            
            var menu = new Menu();
        </script>
        <?php
    }

}


?>