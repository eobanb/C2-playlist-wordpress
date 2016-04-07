<?php $display_composerplaylist = get_post_meta($post->ID, 'display_composerplaylist', True); // checks if custom field 'display_composerplaylist' is True ?>

<?php if($display_composerplaylist == 'True') { ?>

				<style type="text/css">
					table#post-playlist {
						border-collapse: collapse;
					}
					
					table#post-playlist td, table#post-playlist th {
						border:0;
						font-size: 12px;
						padding:8px;
					}
					
					table#post-playlist tr {
						border:1px solid #ccc;
					}
				</style>
				
				<?php $datestamp = get_the_date('Y-m-d'); // uses post date to determine which episode playlist to get ?>
				
				<script type="text/javascript">
				
				$( document ).ready(function() {
				
				ucs = '517ebeaae1c848b3c088ddf3'; // this is WFIU's UCS
				
				url = 'https://api.composer.nprstations.org/v1/widget/'+ucs+'/playlist?prog_id=<?php echo $composer_prog_id; ?>&datestamp=<?php echo $datestamp; ?>';
				
				$.getJSON(url , function(json) {
    				var tbl_body = "";
    				tbl_body += "<tr><th>Track</th><th>Composer</th><th>Artist</th><th>Album</th><th>Buy</th></tr>";   
    				$(json.playlist).each(function() { // selects top playlist
    				
    					$(this.playlist).each(function() { // selects child playlist
    				
        					var tbl_row = "";
        					
        					tbl_row += "<td>"+this.trackName+"</td>";
        					tbl_row += "<td>"+this.composerName+"</td>";
        					tbl_row += "<td>"+this.artistName+"</td>";
        					tbl_row += "<td>"+this.collectionName+"</td>";
        					tbl_row += "<td><a href='"+this.buy.amazon+"'>Buy on Amazon</a></td>";
        					
        					tbl_body += "<tr>"+tbl_row+"</tr>";      
        					
    					})
    				})
    				$("#playlist-loading").empty();
    				$("#post-playlist").html(tbl_body);
				});

				});
				</script>
				
				<table id="post-playlist">
				<span id="playlist-loading">Loading...</span>
				</table>
				
<?php } ?>