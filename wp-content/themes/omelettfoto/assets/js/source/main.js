(function($) {

	// all Javascript code goes here
	$(window).load(function(){

        //Init Fast Click (Removes 300 ms delay from click events on touch devices)
        FastClick.attach(document.body);

        $(".image-grid-item").fancybox({
				openEffect  : 'fade',
				closeEffect : 'fade',
				nextEffect  : 'fade',
				prevEffect  : 'fade',
				showNavArrows: true,
				helpers : {
					thumbs : true
				}
			});


        $('#image-container').imagesLoaded(function(){
        	$('#image-container').masonry({
        		itemSelector: '.image-grid-item',
        		transitionDuration: 0
        	}).masonry('layout');
        })

        var navOpen = false;

        $('#logo').on('click', function(e) {
			if($(window).width() < 1023) // om det är tablet
    		{
			    e.preventDefault();
			}
        	if (navOpen) {
        		
        		$('#navigation ul').children('li').removeClass('show').addClass('hide');
        		setTimeout(function() {
        			$('#navigation ul').children('li').removeClass('hide');
        		}, 301);
        		navOpen = false;
        	}else{
        		console.log("open");
        		navOpen = true;
        		$("#navigation ul").children('li').addClass('show');
        	}
        });

        $('#main').on('click', function() {
        	if (navOpen) {
	        	$('#navigation ul').children('li').removeClass('show').addClass('hide');
	        	setTimeout(function() {
	        		$('#navigation ul').children('li').removeClass('hide');
	        	}, 301);
	        	navOpen = false;
        	}
        });


			// hämtar nästa posts och visar dem på första sidan
			var itterations = 1; // måste vara global
			var fetching = false; // inte massa request samtidigt
			var noMore = false;
			var loop = false; // om det ska loopas att hämta innehåll
			var getNext = function(config){
				var self = this;

				self.url = config.url;
				self.container = config.container;
				self.pagination = $(".imagePagination");
				self.pageLink = $(".imagePagination .nextpostslink, .imagePagination .previouspostslink");
				$('.loading').hide();

				console.log(self.url+self.container);


								var funcs = {
					run:function(loop){
						funcs.hidePagination();
						funcs.ajax()
					},
					hidePagination:function(){
						self.pageLink.hide();
					},
					toggleLoading:function(){
						if ( !$('.loading').is(':visible') ) {
							$('.loading').show();
						}else{
							$('.loading').hide();
						}
						
					},
					ajax:function(){
						funcs.toggleLoading();
						var div;
						$.ajax({
							url: self.url+"page/"+(itterations+1),
							dataType: 'html',
							success: function(data, textStatus, XMLHttpRequest){
								div = $(data).find(self.container);
								itterations +=1;
								console.log(itterations);
							},
							error:function (xhr, ajaxOptions, thrownError){

								var loading = "<p class='loading'>Error: "+xhr.status+"</p>";
								self.pagination.append(loading);
								funcs.toggleLoading();
							}

						}).done(function() {
							funcs.output(div);
						});
					},
					output:function(div){// skriver ut de hämtade objekten
						fetching = false;
						if (div.children('.image-grid-item').length > 0) {
							funcs.toggleLoading();

							div.children('.image-grid-item').each(function(index, el) {
								var element = $(el).addClass('fadeMeIn');
								$(self.container).append(element).masonry("appended", el);
								$(self.container).imagesLoaded(function(){
									$(self.container).masonry('layout');
								});
								noMore = false;
							});
							if (loop) {
								funcs.toBigScreen();
							};
						}else{
							noMore = true;
							loop = false;
							$('.loading').html("Det finns inga fler bilder...");
							noMore = true;
							setTimeout(function() {
								funcs.toggleLoading();
							}, 4000);
						}
					},
					toBigScreen:function(){ // om det inte går att scrolla
						var body 	= $('body').outerHeight(),
						windowH = $(window).outerHeight();
						if (body < windowH) {//om det inte går att scrolla
							fetching = true;
							loop = true;
							funcs.run(true);
						}else{
							loop = false;
						}
					}
				}

					imagesLoaded( document.querySelector('#main'), function( instance ) {
						funcs.toBigScreen();
					});

				window.onresize = function(event) {
					imagesLoaded( document.querySelector('#main'), function( instance ) {
						funcs.toBigScreen();
					});
				};
			//Hämta info när sidan är scrollad till botten
			$(window).scroll(function() {
				if($(window).scrollTop() + $(window).height() == $(document).height() && !fetching && !noMore) {

					fetching = true;
					funcs.run();
				}
			});
				
			}	




			var url = window.location.pathname;
			var Load = new getNext({
				url: url,
				container:"#image-container"
			});


		});

})(jQuery);
