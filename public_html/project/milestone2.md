<table><tr><td> <em>Assignment: </em> IT202 Milestone 2 Shop Project</td></tr>
<tr><td> <em>Student: </em> Akashdeep Singh (as4234)</td></tr>
<tr><td> <em>Generated: </em> 4/24/2023 11:43:37 PM</td></tr>
<tr><td> <em>Grading Link: </em> <a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-008-S23/it202-milestone-2-shop-project/grade/as4234" target="_blank">Grading</a></td></tr></table>
<table><tr><td> <em>Instructions: </em> <ol><li>Checkout Milestone2 branch</li><li>Create a new markdown file called milestone2.md</li><li>git add/commit/push immediate</li><li>Fill in the below deliverables</li><li>At the end copy the markdown and paste it into milestone2.md</li><li>Add/commit/push the changes to Milestone2</li><li>PR Milestone2 to dev and verify</li><li>PR dev to prod and verify</li><li>Checkout dev locally and pull changes to get ready for Milestone 3</li><li>Submit the direct link to this new milestone2.md file from your GitHub prod branch to Canvas</li></ol><p>Note: Ensure all images appear properly on github and everywhere else. Images are only accepted from dev or prod, not local host. All website links must be from prod (you can assume/infer this by getting your dev URL and changing dev to prod).</p></td></tr></table>
<table><tr><td> <em>Deliverable 1: </em> Users with admin or shop owner will be able to add products </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshot of admin create item page</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234143836-83b48b2a-c543-4e8e-9054-d0b96fdc57dd.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Add item admin page filled with valid data, from heroku dev, url visible<br><br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add screenshot of populated Products table clearly showing the columns</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234145245-1d2cf743-687f-452a-bc0f-82209db40fb0.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of Products table with the previous filled item, from VSCode<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Briefly describe the code flow for creating a Product</td></tr>
<tr><td> <em>Response:</em> <div>We have most of the logic in our add_items.php file. There is an<br>form in the which collects the data. The beginning of the form we<br>make use of the get_columns() helper function which gives us all our columns<br>for our table. We then ignore id, modified and created as these are<br>auto populated. Inside our form we loop over each of the fields in<br>the columns and if they are not set we display them to the<br>user on the form. Once the user fills out the data in the<br>form and submits the form we call the save_data() helper function. This function<br>takes the table name and the entire post request as arguments and then<br>uses array_filter to get the columns and array_map to map user inserted values<br>to these columns. In the end we map our columns to our placeholder<br>and execute an INSERT command into our table. If successful we return the<br>ID of the last added product and display it using a flash message,<br>if unsuccessful we log the error and display a flash for failure event.</div><br></td></tr>
<tr><td> <em>Sub-Task 4: </em> Add related pull request link(s)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/singak1/IT202-008/pull/47">https://github.com/singak1/IT202-008/pull/47</a> </td></tr>
<tr><td> <em>Sub-Task 5: </em> Add a direct link to heroku prod for this file</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://as4234-prod.herokuapp.com/project//admin/add_item.php">https://as4234-prod.herokuapp.com/project//admin/add_item.php</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 2: </em> Any user can see visible products on the Shop Page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add a screenshot of the Shop page showing 10 items without filters/sorting applied</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234148373-b772d465-edae-40d4-a332-9fa3d12937b5.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of 10 items on the shop page no filters applied. Heroku dev<br>url visible.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot of the Shop page showing both filters and a different sorting applied (should be more than 1 sample product)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234148728-25e1d586-51dc-47cb-a948-0025551979d7.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of both filters applied and sorted by High to Low price. Heroku<br>dev url visible.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add a screenshot of the filter/sort logic from the code</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234149122-d4b7b858-0022-4408-9729-7e42119da588.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of the code for filter/sort logic, ucid and date visible.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 4: </em> Briefly explain how the results are shown and how the filters are applied</td></tr>
<tr><td> <em>Response:</em> <p>In summary, to achieve the sorting and filter to work properly I had<br>added a few inputs to my form to get user input for these<br>filters. Then I set these input values in my POST request once a<br>user clicks on the apply filter button. In the beginning of my code<br>i set these parameters to be empty and if they are empty I<br>adjust my SQL query to not include them in the fetching of the<br>data. However if they are set to a something I then bind these<br>parameters to my statement and modify my SQL statement as necessary. If the<br>category filter is set then I select only the items that match the<br>category if name_filter is set then I do a partial match and only<br>include those items and if price filter is set to High to Low<br>then we order by DESC or ASC. Also we limit the results to<br>10 as we are asked to only fetch 10 items per load. <br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 5: </em> Add related pull request link(s)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/singak1/IT202-008/pull/51">https://github.com/singak1/IT202-008/pull/51</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/singak1/IT202-008/pull/52">https://github.com/singak1/IT202-008/pull/52</a> </td></tr>
<tr><td> <em>Sub-Task 6: </em> Add a direct link to heroku prod for this file</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://as4234-prod.herokuapp.com/project//shop.php">https://as4234-prod.herokuapp.com/project//shop.php</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 3: </em> Show Admin/Shop Owner Product List (this is not the Shop page and should show visibility status) </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshot of the Admin List page/results</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234150594-1cfaa655-6c90-4db2-ace6-78aa5261d108.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of the list products page, the first item is set to false<br>for visibility but is shown here, from heroku, dev url visible.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Briefly explain how the results are shown</td></tr>
<tr><td> <em>Response:</em> <p>I created a list_products.php file in my admin pages. This page first checks<br>if the user is an admin or shop owner using the has_role() function<br>that we created and described in the previous milestone. On successful authentication we<br>make sure user has entered a name to filter the results by, this<br>can be left blank to get all products. Once the user sends a<br>POST request we make the following query statement <b><u>$stmt = $db-&gt;prepare(&quot;SELECT id, name,<br>description, category, stock, created, modified, unit_price, visibility from $TABLE_NAME WHERE name like :name<br>LIMIT 10&quot;);</u></b><u> </u>And before executing the command we assign our placeholder for name<br><b><u>[&quot;:name&quot; =&gt; &quot;%&quot; . $_POST[&quot;name&quot;] . &quot;%&quot;]</u></b><u> </u>This sets wildcard for our SQL<br>for matching and then this statement is executed and the fetched data is<br>displayed on our website html table.<br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add related pull request link(s)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/singak1/IT202-008/pull/48">https://github.com/singak1/IT202-008/pull/48</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Add a direct link to heroku prod for this file</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://as4234-prod.herokuapp.com/project//admin/list_products.php">https://as4234-prod.herokuapp.com/project//admin/list_products.php</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 4: </em> Admin/Shop Owner Edit button </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add a screenshot showing the edit button visible to the Admin on the Shop page</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234154521-9f13bd28-585f-4c4b-a670-6f4e56d6350f.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of edit button from the public visible shop for admin user. Heroku<br>url visible.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot showing the edit button visible to the Admin on the Product Details Page</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234155758-fc279e73-b6f3-4b79-85e8-1806a95d37eb.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of available edit button for admin user, on the product_detail page.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add a screenshot showing the edit button visible to the Admin on the Admin Product List Page (The admin page)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234156075-aa115a3b-15b0-4ab3-a6cf-3c4246ef2b5b.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot with edit button for admin user from the list_products page, heroku dev<br>url visible.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 4: </em> Add a before and after screenshot of Editing a Product via the Admin Edit Product Page</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234156541-247d6ac7-041b-4ed7-878a-b9973ffc2b2a.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of admin changing visibility to true for an item with success message,<br>from heroku dev.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234156769-1b3ee22b-709c-47ca-88f0-376478e8a6f4.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of the database before update<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234157177-2cf50602-8ba2-4582-b65f-b821a626b187.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of the database afterupdate<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 5: </em> Briefly explain the code process/flow</td></tr>
<tr><td> <em>Response:</em> <p>All the brains of this deliverable are in the edit_item.php file i created.<br>This page is in our admin pages folder as only admins/shop owners can<br>edit items and logically it has the has_role() check in the beginning to<br>ensure permissions. Just like the add items page this page also has a<br>form that is created by the get_columns() helper function, here we also ignore<br>the id and created and modified columns as they shouldnt be changed by<br>the user. Once submitted we call the update_products() helper function. This function takes<br>in table name, id and the post request as parameters. Our update_products function<br>uses basically the same steps as I explained in task 3 for deliverable<br>1. Here the main difference is that instead of our SQL statement being<br>a CREATE it is an UPDATE statement here.<br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 6: </em> Add related pull request link(s)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/singak1/IT202-008/pull/49">https://github.com/singak1/IT202-008/pull/49</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/singak1/IT202-008/pull/60">https://github.com/singak1/IT202-008/pull/60</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/singak1/IT202-008/pull/61">https://github.com/singak1/IT202-008/pull/61</a> </td></tr>
<tr><td> <em>Sub-Task 7: </em> Add a direct link to heroku prod for this file</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://as4234-prod.herokuapp.com/project//admin/edit_products.php?id=1">https://as4234-prod.herokuapp.com/project//admin/edit_products.php?id=1</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 5: </em> Product Details Page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add a screenshot showing the button (clickable item) that directs the user to the Product Details Page</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234159555-b2619510-ecab-43e8-9a06-c6034d14532b.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of the card being clickable to lead to the details page. Heroku<br>dev url visible.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot showing the result of the Product Details Page</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234159772-0519bfd3-ee6e-4b88-aed4-f2f0a4ec833a.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of the product details page, heroku dev url visible.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Briefly explain the code process/flow</td></tr>
<tr><td> <em>Response:</em> <p>To make my entire clickable(except inputs and buttons) I created an anchor tag<br>in my product card and used bootstraps strechable-link class, this made my entire<br>card into a clickable button. Once clicked on this links to the our<br>prodcut_details.php page, I used php to set the id of the item being<br>clicked, since this is public its visible in the url at the top.<br>Our product_details page handles out of stock items and will not display them.<br>On the product_details side of things we get the id from the GET<br>request we generated from the click and create the SQL statement <b><u>$stmt =<br>$db-&gt;prepare(&quot;SELECT id, name, description, category, stock, created, modified, unit_price, visibility from $TABLE_NAME WHERE<br>id = :id AND visibility = &#39;true&#39; &quot;);</u></b><u> </u>this is just a plain<br>SELECT statement, we get all the info for the product from the request<br>and make sure that the visibility is true. On success I have some<br>html to display a container with all the necessary info. On fail I<br>redirect users to the shop page so if someone tries to get details<br>of a non visible page they will be redirected to the shop page.<br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 4: </em> Add related pull request link(s)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/singak1/IT202-008/pull/53">https://github.com/singak1/IT202-008/pull/53</a> </td></tr>
<tr><td> <em>Sub-Task 5: </em> Add a direct link to heroku prod for this file (can be any specific item)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://as4234-prod.herokuapp.com/project//product_details.php?id=4">https://as4234-prod.herokuapp.com/project//product_details.php?id=4</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 6: </em> Add to Cart </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add a screenshot of the success message of adding to cart</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234161343-54ebf4aa-2d72-4702-b672-3c4fb110f4ee.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of the item added to cart success message, heroku dev url visible.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot of the error message of adding to cart (i.e., when not logged in)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234161923-e0ea3834-9c93-4b7d-a34c-9f074173f64a.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of error message for non logged in user, also redirect user to<br>the login page. Heroku dev url visible.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add a screenshot of the Cart table with data in it</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234162351-9d9ef02a-69dd-47ce-8017-5e6af3f0ea98.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of the database of the cart, highlighted the item added in the<br>above screenshot.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 4: </em> Tell how your cart works (1 cart per user; multiple carts per user)</td></tr>
<tr><td> <em>Response:</em> <p>I opted for the one cart per user functionality =&gt; a user can<br>have only 1 cart product_id and user_id should be a composite unique key.<br></p><br></td></tr>
<tr><td> <em>Sub-Task 5: </em> Explain the process of add to cart</td></tr>
<tr><td> <em>Response:</em> <p>My cart is first checks if a user is logged in, and once<br>the user clicks<br> on the add to cart button I redirect the user<br>to the cart.php page with<br> action set to add and the item_id, desired_quantity<br>in the request. In <br>my cart.php file I have a switch statement that<br>i run on the action that<br> i set through my POST request. For<br>the add, i bind product id, desired <br>quantity from the POST request and<br>get the user id from the helper <br>function we created last milestone. The<br>complete SQL statement i run <br>with the bound variables is <b>$query = &quot;INSERT<br>INTO Cart (product_id, <br>desired_quantity, unit_price, user_id) VALUES (:pid, :dq, (SELECT <br>unit_price FROM Products<br>WHERE id = :pid), :uid) ON DUPLICATE KEY UPDATE<br> desired_quantity = desired_quantity +<br>:dq&quot;; </b>On success an item is <br>added to the cart table and a<br>flash message is displayed and on failure <br>an error flash message is displayed<br>and the error is logged.<br></p><br></td></tr>
<tr><td> <em>Sub-Task 6: </em> Add related pull request link(s)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/singak1/IT202-008/pull/54">https://github.com/singak1/IT202-008/pull/54</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 7: </em> User will be able to see their Cart </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshot of the Cart View</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234164247-3f7a73f4-ae8a-4352-90f0-97feb365c3cf.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of the cart, has subtoal, cart total which adds up correctly. The<br>item names are clickable links to the product details page, heroku dev url<br>visible.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explain how the cart is being shown from a code perspective along with the subtotal and total calculations</td></tr>
<tr><td> <em>Response:</em> <p>A SQL query is run on the Cart table after the add/edit/delete/clear logic<br>so that the cart always has up to date info. It retrieves cart<br>data from a database using a prepared SQL query, and <br>displays the items<br>in a table with columns for item name, price, <br>quantity, subtotal, and actions.<br>The code uses PHP to dynamically <br>generate HTML content. It calculates the total<br>cost of the items in the <br>cart and provides options to update the<br>quantity, delete items, and <br>clear the entire cart. If there are no items<br>in the cart, a message is <br>displayed indicating so. The main SQL query<br>used here is <b>$query = &quot;SELECT cart.id, product.name, product.stock, cart.unit_price, (cart.unit_price * cart.desired_quantity)<br>as subtotal, cart.desired_quantity FROM Products as product JOIN Cart as cart on cart.product_id<br>= product.id WHERE cart.user_id = :uid&quot;; </b>This is pretty self explanatory from the<br>previous tasks.<br><br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add related pull request link(s)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/singak1/IT202-008/pull/55">https://github.com/singak1/IT202-008/pull/55</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Add a direct link to heroku prod for this file</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://as4234-prod.herokuapp.com/project//cart.php">https://as4234-prod.herokuapp.com/project//cart.php</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 8: </em> User can update cart quantity </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Show a before and after screenshot of Cart Quantity update</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234165296-57700f0c-d9f4-464a-9220-d99580929e49.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of the cart before updating quantity highlighted. Heroku URL visible.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234165511-b44f5c45-960b-46a5-8378-e7e0e0eb29cc.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of the cart after updated quantity highlighted, success message visible. Heroku dev<br>URL visible.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Show a before and after screenshot of setting Cart Quantity to 0</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234165511-b44f5c45-960b-46a5-8378-e7e0e0eb29cc.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of the cart before updating quantity to 0. Heroku dev url visible.<br>Used from last task.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234165849-dc655b32-b29b-4763-8382-ed99027dde1b.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of the cart after updating quantity to 0, showing success message. Heroku<br>dev url visible.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Show how a negative quantity is handled</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234166370-964e906b-b0bd-4136-a7c8-a774c4d299ab.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Error message when user tries to enter negative value, shown as the input<br>field has a min restriction. Heroku dev url visible.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234167322-c27ca408-102c-47f3-a845-55d9efb65605.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Error message when user tries to enter negative value, shown after removing the<br>min restriction, not from herkou as this would need to push bad code<br>to my prod.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 4: </em> Explain the update process including how a value of 0 and negatives are handled</td></tr>
<tr><td> <em>Response:</em> <p>If the desired quantity is set to a value less than 0, a<br>flash message is displayed with a warning indicating that the quantity cannot be<br>set to negative values. The <code>die()</code> function is then called to stop further<br>execution of the script, and the user is redirected back to the cart<br>page.</p><p>If the desired quantity is set to 0, the code will delete the<br>corresponding item from the cart by executing a DELETE query in the database,<br>and a flash message is displayed indicating that the item has been successfully<br>removed from the cart.</p><br></td></tr>
<tr><td> <em>Sub-Task 5: </em> Add related pull request link(s)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/singak1/IT202-008/pull/56">https://github.com/singak1/IT202-008/pull/56</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 9: </em> Cart Item Removal </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add a before and after screenshot of deleting a single item from the Cart</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234167974-5099bd2f-ad0f-4bb2-9b89-bace6fcf1b71.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of cart before removing 1st item in cart. Heroku dev url visible.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234168147-b2fd2999-9b6a-45fb-89b7-3486870914dd.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of cart after removing 1st item in cart. Heroku dev url visible.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a before and after screenshot of clearing the cart</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234168361-638f4c51-b5b9-4e4e-9f28-43dc8062757c.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of the cart before clearing it out. Heroku dev url visible.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234168522-e4e65aa0-4080-4358-9cbc-e97b2ca4a0d8.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of the cart after clearing it out, success message visible. Heroku dev<br>url visible.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Briefly explain how each delete process works</td></tr>
<tr><td> <em>Response:</em> <ol><li><p>"Delete" Case:<br>In this case, the code is designed to remove a specific item<br>from the cart. The item to be deleted is identified by its "cart_id"<br>which is obtained from the <code>$_POST</code> data. The SQL query <code>DELETE FROM Cart<br>WHERE id = :cid AND user_id = :uid</code> is prepared with placeholders for<br>the "cart_id" and "user_id" values to prevent SQL injection. The <code>bindValue()</code> method is<br>used to bind the actual values to the placeholders. The <code>execute()</code> method is<br>then called to execute the SQL query. If the query is executed successfully,<br>a flash message is displayed indicating that the item has been successfully removed<br>from the cart. If there is an exception (PDOException) during the query execution,<br>an error message is logged, and a flash message is displayed indicating that<br>there was an error removing the item from the cart with a "danger"<br>alert style.</p></li><li><p>"Clear" Case:<br>In this case, the code is designed to remove all items<br>from the cart for the current user. The SQL query <code>DELETE FROM Cart<br>WHERE user_id = :uid</code> is prepared with a placeholder for the "user_id" value,<br>and the <code>bindValue()</code> method is used to bind the actual value of the<br>user_id to the placeholder. The <code>execute()</code> method is then called to execute the<br>SQL query. If the query is executed successfully, a flash message is displayed<br>indicating that all items have been successfully removed from the cart. If there<br>is an exception (PDOException) during the query execution, an error message is logged,<br>and a flash message is displayed indicating that there was an error removing<br>items from the cart with a "danger" alert style.</p></li></ol><br></td></tr>
<tr><td> <em>Sub-Task 4: </em> Add related pull request link(s)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/singak1/IT202-008/pull/58">https://github.com/singak1/IT202-008/pull/58</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/singak1/IT202-008/pull/59">https://github.com/singak1/IT202-008/pull/59</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 10: </em> Misc </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots showing which issues are done/closed (project board) Incomplete Issues should not be closed (Milestone2 issues)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/234169248-85414915-d9b7-41aa-a58e-5e650e2de8bf.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of the project board with all Milestone2 issues closed and in the<br>Milestone2-&gt;Done column. All Items were completed so there were no incompleted tasks.<br></p>
</td></tr>
</table></td></tr>
</table></td></tr>
<table><tr><td><em>Grading Link: </em><a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-008-S23/it202-milestone-2-shop-project/grade/as4234" target="_blank">Grading</a></td></tr></table>