<?php include("includes/header.php");?>
<div id="mainwrapperInner" class="col-md-12 sacraments">
     <figure class="banner">
    <img src="resources/images/banner/bannerSacraments.png" alt="Sacraments" title="Sacraments"/>
    </figure>
    <div class="col-md-12 mainContent">
               <h2>SACRAMENTS - <em>An outward sign of inward grace</em></h2>

   <aside class="col-md-2"></aside>
    <artile class="col-md-8" style="background:#f5f5f5;">
          <nav class="subnav col-md-4">
        <ul>
            <li><a href="#baptism" class="active">Baptism </a></li>
            <li><a href="#firsthollycommunions">First Holy Communion</a></li>
            <li><a href="#confirmation">Confirmation</a></li>
            <li><a href="#confession">Confession</a></li>
            <li><a href="#matrimony">Matrimony</a></li>
            <li><a href="#anointingofthesick">Anointing of the sick</a></li>
            <li><a href="#sacramentsoforders">Sacrament of orders</a></li>
        </ul>
    </nav>
    <artile class="col-md-8">
      
       <div id="baptism" style="padding:5em 0;overflow:hidden;">
         <figure class="col-md-4">
             <img src="resources/images/sacraments.png" alt="Sacraments" title="Sacraments"/>
        </figure>
           <p class="col-md-8">The Sacrament of Baptism is often called "The door of the Church," because it is the first of the seven sacraments no only in time (since most Catholics receive it as infants) but in priority, since the reception of the other sacraments depends on it.</p>
       </div>
    <div id="firsthollycommunions" class="hide" style="padding:5em 0;overflow:hidden;">
          <figure class="col-md-4">
             <img src="resources/images/sacraments.png" alt="Sacraments" title="Sacraments"/>
        </figure>
         <p class="col-md-8">Holy Communion is the receiving of Jesus Christ in the sacrament of the Holy Eucharist. (a) Just as it is necessary to nourish our bodies with material food, so also it is necessary to nourish our souls with spiritual food.</p>
    </div>
     <div id="confirmation"  class="hide" style="padding:5em 0;overflow:hidden;">
         <figure class="col-md-4">
             <img src="resources/images/sacraments.png" alt="Sacraments" title="Sacraments"/>
        </figure>
         <p class="col-md-8">Confirmation is a rite of initiation in several Christian denominations, normally carried out through anointing, the laying on of hands, and prayer, for the purpose of bestowing the Gift of the Holy Spirit. In Christianity, confirmation is seen as the sealing of the covenant created in Holy Baptism.</p>
    </div>
     <div  id="confession"  class="hide" style="padding:4em 0;overflow:hidden;">
         <figure class="col-md-4">
             <img src="resources/images/sacraments.png" alt="Sacraments" title="Sacraments"/>
        </figure>
         <p class="col-md-8">For the Catholic Church, the intent of this sacrament is to provide healing for the soul as well as to regain the grace of God, lost by sin. A perfect act of contrition even outside of confession removes the eternal punishment associated with mortal sin but a Catholic is obliged to confess his or her mortal sins at the earliest opportunity. In theological terms, the priest acts in persona Christi and receives from the Church the power of jurisdiction over the penitent.</p>
    </div>
    <div id="matrimony"  class="hide" style="padding:5em 0;overflow:hidden;">
        <figure class="col-md-4">
             <img src="resources/images/sacraments.png" alt="Sacraments" title="Sacraments"/>
        </figure>
         <p class="col-md-8">Marriage in the Catholic Church, also called matrimony, is the "covenant by which a man and a woman establish between themselves a partnership of the whole of life and which is ordered by its nature to the good of the spouses and the procreation and education of offspring", and which "has been raised by Christ the Lord to the dignity of a sacrament between the baptised."</p>
    </div>
     <div id="anointingofthesick" class="hide" style="padding:5em 0;overflow:hidden;">
         <figure class="col-md-4">
             <img src="resources/images/sacraments.png" alt="Sacraments" title="Sacraments"/>
        </figure>
         <p class="col-md-8">Anointing of the Sick is a sacrament of the Catholic Church that is administered to a Catholic "who, having reached the age of reason, begins to be in danger due to sickness or old age", except in the case of those who "persevere obstinately in manifest grave sin".</p>
    </div>
      <div id="sacramentsoforders" class="hide" style="padding:5em 0;overflow:hidden;">
          <figure class="col-md-4">
             <img src="resources/images/sacraments.png" alt="Sacraments" title="Sacraments"/>
        </figure>
         <p class="col-md-8">Sacraments of holy orders in the Catholic Church includes three orders: bishop, priest, and deacon. The Church regards ordination as a Sacrament. In the phrase "holy orders", the word "holy" simply means "set apart for some purpose." The word "order" designates an established civil body or corporation with a hierarchy, and ordination means legal incorporation into an ordo. In context, therefore, a holy order is simply a group with a hierarchical structure that is set apart for ministry in the Church.</p>
    </div>
    </artile>
    <aside class="col-md-2"></aside>
</div>
 </div>
<script type="text/javascript">

   $(function(){
$('a').click(function(){
    event.preventDefault();
    var myid = this.hash.substr(1);
    $('.subnav li a').removeClass('active');
    $(this).addClass('active');
    $("#"+myid).addClass('show').siblings('div').removeClass('show').addClass('hide');
    });
    });
   </script>
<?php include("includes/footer.php");?>