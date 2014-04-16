(function($) {

	// all Javascript code goes here
    $(window).load(function(){

        //Init Fast Click (Removes 300 ms delay from click events on touch devices)
        FastClick.attach(document.body);

		$(".fancybox").fancybox();


		$('#image-container').masonry({
		  itemSelector: '.image-grid-item'
		});

		//taxonomy sortering

		$('.taxonomyNav').on('click', function(){

		});

			// hämtar nästa posts och visar dem på första sidan
			var itterations = 1; // måste vara global
			var fetching = false; // inte massa request samtidigt
			var noMore = false;
			var getNext = function(config){
				var self = this;

				self.url = config.url;
				self.container = config.container;
				self.pagination = $(".pagination");
				self.pageLink = $(".nextpostslink, .previouspostslink");

				console.log(self.url+self.container);

				
			}	


			getNext.prototype.runGet = function(){
				self = this;
				console.log("running");

				var funcs = {
					run:function(){
						funcs.hidePagination();
						funcs.ajax()
					},
					hidePagination:function(){
						self.pageLink.hide();
					},
					toggleLoading:function(){
						if ($('.loading').length < 1) {
							var loading = "<p class='loading'>Laddar...</p>"
							self.pagination.append(loading);
						}else{
							$('.loading').remove();
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
								alert(xhr.status);
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
								var index = 0;
								setTimeout(function() {//lägg till en efter en
									$(self.container).append(el).masonry("appended", el);
									index ++;
								}, 100 * index);
								
								noMore = false;
							});
						}else{
							noMore = true;
							$('.loading').html("Det finns inga fler bilder...")
							setTimeout(function() {
								funcs.toggleLoading();
							}, 2000);
						}
					}
				}

					console.log("gathering runnng")
					funcs.run();
				
			}





			var tester = new getNext({
				url: "http://localhost/omeletfoto/",
				container:"#image-container"
			});

			
			//load more when user is at the bottom
			$(window).scroll(function() {
			   if($(window).scrollTop() + $(window).height() == $(document).height() && !fetching) {
			   	fetching = true;
			   	console.log(noMore);
			       tester.runGet();
			   }
			});
    });

})(jQuery);
