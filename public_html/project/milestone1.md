<table><tr><td> <em>Assignment: </em> IT202 Milestone1 Deliverable</td></tr>
<tr><td> <em>Student: </em> Akashdeep Singh (as4234)</td></tr>
<tr><td> <em>Generated: </em> 4/11/2023 12:51:08 AM</td></tr>
<tr><td> <em>Grading Link: </em> <a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-008-S23/it202-milestone1-deliverable/grade/as4234" target="_blank">Grading</a></td></tr></table>
<table><tr><td> <em>Instructions: </em> <ol><li>Checkout Milestone1 branch</li><li>Create a milestone1.md file in your Project folder</li><li>Git add/commit/push this empty file to Milestone1 (you'll need the link later)</li><li>Fill in the deliverable items<ol><li>For each feature, add a direct link (or links) to the expected file the implements the feature from Heroku Prod (I.e,&nbsp;<a href="https://mt85-prod.herokuapp.com/Project/register.php">https://mt85-prod.herokuapp.com/Project/register.php</a>)</li></ol></li><li>Ensure your images display correctly in the sample markdown at the bottom</li><ol><li>NOTE: You may want to try to capture as much checklist evidence in your screenshots as possible, you do not need individual screenshots and are recommended to combine things when possible. Also, some screenshots may be reused if applicable.</li></ol><li>Save the submission items</li><li>Copy/paste the markdown from the "Copy markdown to clipboard link" or via the download button</li><li>Paste the code into the milestone1.md file or overwrite the file</li><li>Git add/commit/push the md file to Milestone1</li><li>Double check the images load when viewing the markdown file (points will be lost for invalid/non-loading images)</li><li>Make a pull request from Milestone1 to dev and merge it (resolve any conflicts)<ol><li>Make sure everything looks ok on heroku dev</li></ol></li><li>Make a pull request from dev to prod (resolve any conflicts)<ol><li>Make sure everything looks ok on heroku prod</li></ol></li><li>Submit the direct link from github prod branch to the milestone1.md file (no other links will be accepted and will result in 0)</li></ol></td></tr></table>
<table><tr><td> <em>Deliverable 1: </em> Feature: User will be able to register a new account </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add one or more screenshots of the application showing the form and validation errors per the feature requirements</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231042852-2dd717ef-5be1-43e2-9cc1-0192b33bd863.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Email validation during registeration, from heroku dev.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231043292-49520deb-6486-4037-938a-4b17e484d75b.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Password validation during login, heroku dev url visible.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231043748-ea1b1651-fb33-4f9a-9db0-a04556f3e646.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Password not matching validation,  heroku dev url visible.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231044196-e614b4f8-2ac6-4cf4-bd32-2eb4ddf1347e.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Email not available validation for already registered emails, heroku dev url visible.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231044737-4135fb70-23ff-40e4-8ae9-7ee129b46336.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Username already taken validation, heroku dev url visible.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231046043-d71b5bc7-a3cd-46d2-b5ae-2c834edb5de3.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Completed form with valid data before being submitted, heroku dev url visible.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot of the Users table with data in it</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231046493-2d585a80-ca03-4503-a08c-381d7f18faed.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screengrab of the users table with user from Task1 highlighted with a red<br>border.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add the related pull request(s) for this feature</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/singak1/IT202-008/pull/11">https://github.com/singak1/IT202-008/pull/11</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Explain briefly how the process/code works</td></tr>
<tr><td> <em>Response:</em> <div>The form has 5 input fields, email, username, password, confirm, and register. Register<br>is of submit type and we have a client side validation funciton that<br>triggers on submit. This validation function holds our client-side validation for all the<br>fields. Email is a regex that checks for valid email addresses, username makes<br>sure there are atleast 3 lowercase alphanumeric and _- characters, password makes sure<br>there are atleast 8 characters and there is match check to make sure<br>the passwords matches. If any of these validations fail the form wont be<br>submitted. <br></div><div><br></div><div>If the data is valid, the form is sent to the backend,<br>where the same checks are performed again. Then the password is hashed using<br>the PASSWORD_BCRYPT and then we get the database and run the INSERT INTO<br>command to insert a users info into the users table. On successful insertion<br>our user is registered.<br> </div><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 2: </em> Feature: User will be able to login to their account </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add one or more screenshots of the application showing the form and validation errors per the feature requirements</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231048601-eb7013cb-6016-43d7-9eba-f473d5e0746e.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Password mismatch validation, heroku dev url visible.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231048779-722ba51a-c7fd-44a0-adfb-bfc1bd5b6945.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Non registered user validation, herkou dev url visible.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot of successful login</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231048915-8b860ad1-f7ea-4875-8b70-072de4596deb.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Successful user login with a flash welcome message.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add the related pull request(s) for this feature</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/singak1/IT202-008/pull/13">https://github.com/singak1/IT202-008/pull/13</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Explain briefly how the process/code works</td></tr>
<tr><td> <em>Response:</em> <p>The form here only has 3 inputs, username/email field, password field and login.<br>Here the login is of submit type and the validation on both client<br>and server side is handled as explained above. On valid data entry in<br>the form we get the database and run a SELECT statement on our<br>users table to get the email and password, this is to make sure<br>that a user exists in our table, after that we get our users<br>password and verify it using password_verify. If all goes well we log the<br>user in, else we throw a flash message with what went wrong.<br><br></p><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 3: </em> Feat: Users will be able to logout </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add a screenshot showing the successful logout message</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231049877-4a2516da-28d9-403f-b3e5-49afeaea40d6.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Successful userlog out, with flash message visibe.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot showing the logged out user can't access a login-protected page</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231050044-39c3d2d4-eaba-438b-af3c-ffb89865a8ff.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Unsuccessful attempt to access a log-in protected page, flash message and herkou url<br>visible.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add the related pull request(s) for this feature</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/singak1/IT202-008/pull/12">https://github.com/singak1/IT202-008/pull/12</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Explain briefly how the process/code works</td></tr>
<tr><td> <em>Response:</em> <p>To achieve the above we use sessions and cookies to our webpages, once<br>a user logs out we call the reset session function which basically unsets<br>the session and destroys it before restarting it. This makes sure no one<br>can use the back button to gain access to login protected pages. Once<br>a user logs in with valid credentials we set a session, which follows<br>the user around our website until it is destroyed but the user logging<br>out.<br><br></p><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 4: </em> Feature: Basic Security Rules Implemented / Basic Roles Implemented </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add a screenshot showing the logged out user can't access a login-protected page (may be the same as similar request)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231050044-39c3d2d4-eaba-438b-af3c-ffb89865a8ff.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>User unable to access a log in protected page.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot showing a user without an appropriate role can't access the role-protected page</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231051112-f3259cf3-4ebe-43da-8c42-b7e35246b44e.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Non admin trying to access admin page, heroku dev url visible.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add a screenshot of the Roles table with valid data</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231051333-4a948184-7931-40d6-8785-88266d217696.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screen grab of the Roles table with Admin role.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 4: </em> Add a screenshot of the UserRoles table with valid data</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231051514-8093f1a3-b417-4fb9-be5a-831318b5d515.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>The user with id-&gt;1 from the users table, in my case username &quot;akash&quot;<br>as visible in above screenshot from task1.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 5: </em> Add the related pull request(s) for these features</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/singak1/IT202-008/pull/18">https://github.com/singak1/IT202-008/pull/18</a> </td></tr>
<tr><td> <em>Sub-Task 6: </em> Explain briefly how the process/code works for login-protected pages</td></tr>
<tr><td> <em>Response:</em> <p>To achieve user roles, we have 2 new tables, Roles and User Roles.<br>On successful login we JOIN these tables and get the userid which has<br>a certain role. Once we have a userid and roleid we use fetchAll<br>to get the role and during setting the session we assign a role<br>to the users session.<br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 7: </em> Explain briefly how the process/code works for role-protected pages</td></tr>
<tr><td> <em>Response:</em> <p>To avoid non admins accessing admin pages we have a helper function called<br>has_role, this function checks if user is logged in and has a session<br>set. If these are satisfied then we loop over the roles set in<br>the session during log in and confirm if the argument passed to this<br>function matches one of the roles set to the user session. If the<br>user doesn&#39;t have that role, here admin, the user is redirected to the<br>home page and a flash message is displayed.<br><br></p><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 5: </em> Feature: Site should have basic styles/theme applied; everything should be styled </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots to show examples of your site's styles/theme</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231053109-b7e4c691-2b9f-4932-9225-61328903790b.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Styled log in form, with the modern UI theme, also applied to the<br>nav bar, heroku dev url visible.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add the related pull request(s) for this feature</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/singak1/IT202-008/pull/29">https://github.com/singak1/IT202-008/pull/29</a> </td></tr>
<tr><td> <em>Sub-Task 3: </em> Briefly explain your CSS at a high level</td></tr>
<tr><td> <em>Response:</em> <div>I just made some basic changes, first changed the color theme to something<br>more modern. I added some padding to the nav bar, added some highlighting<br>on hover for the nav bar. Also changed the font size for accessibility<br>and to make the page more cleaner.</div><div>Changed the font type to Open Sans<br>or sans-serif as these are the fonts used by Google. some css selectors<br>used are:</div><div><ol><li>nav { padding: .8pt; background-color: #a2c4e3; }</li><li>nav li a{<br>&nbsp;&nbsp;&nbsp; text-decoration: none;<br>&nbsp;&nbsp;&nbsp; color:<br>#333;<br>&nbsp;&nbsp;&nbsp; font-weight: bold;<br>&nbsp;&nbsp;&nbsp; font-size: 20px;<br>&nbsp;&nbsp;&nbsp; padding: 10px;<br>&nbsp;&nbsp;&nbsp; transition: all 0.2s ease-in-out;<br>&nbsp;&nbsp;&nbsp; border-radius: 5%;<br>}</li><li>nav<br>li a:hover{background-color: #6c757d; color: #fff;}</li><li>body{<br>&nbsp;&nbsp;&nbsp; margin: 0px;<br>&nbsp;&nbsp;&nbsp; font-family: 'Open Sans', sans-serif;<br>&nbsp;&nbsp;&nbsp; background-color: #f5f5f5;<br>&nbsp;&nbsp;&nbsp;<br>color: #333;<br>}<br></li></ol></div><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 6: </em> Feature: Any output messages/errors should be "user friendly" </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots of some examples of errors/messages</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231043748-ea1b1651-fb33-4f9a-9db0-a04556f3e646.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>User friendly message showing that the passwords entered dont match during registeration, from<br>heroku dev.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231044737-4135fb70-23ff-40e4-8ae9-7ee129b46336.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>User friendly message showing that the username isnt available during registeration, from heroku<br>dev.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231044196-e614b4f8-2ac6-4cf4-bd32-2eb4ddf1347e.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>User friendly message showing that the email isnt available during registeration, from heroku<br>dev.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a related pull request</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/singak1/IT202-008/pull/11">https://github.com/singak1/IT202-008/pull/11</a> </td></tr>
<tr><td> <em>Sub-Task 3: </em> Briefly explain how you made messages user friendly</td></tr>
<tr><td> <em>Response:</em> <p>To achieve some user friendly messages, we are aware of the most common<br>errors users may run into. One example is using a duplicate username, or<br>a username someone is already registered with. We have helper function that checks<br>duplicate users and breaks down the SQL error if the code matches the<br>duplicate data error code, we take the error message and extract the data<br>we need, here the username and flash a message saying that this username<br>is already taken.<br><br></p><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 7: </em> Feature: Users will be able to see their profile </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots of the User Profile page</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231054908-2072f6e3-e032-462c-ac4c-ad215e4ca12e.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>User profile page with email and username prefilled, from heroku dev.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add the related pull request(s) for this feature</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/singak1/IT202-008/pull/15">https://github.com/singak1/IT202-008/pull/15</a> </td></tr>
<tr><td> <em>Sub-Task 3: </em> Explain briefly how the process/code works (view only)</td></tr>
<tr><td> <em>Response:</em> <p>To prefill the email and username data in the form, we make sure<br>the user is logged in. If the user is logged in we can<br>simply call our helper functions get_username() and get_user_email(), these functions use the seesion<br>to get the username and email and we use our saferecho function to<br>prefill these values to the profile form.<br><br></p><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 8: </em> Feature: User will be able to edit their profile </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots of the User Profile page validation messages and success messages</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231055559-cab9c60f-97c0-4e01-af0a-0fd60513273d.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Username validation message, from heroku dev.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231056898-1ee75f75-17b8-45df-9c8b-e75fe098f0b0.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Email validation message, from heroku dev.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231057147-8be44c90-4ab0-43e0-aa91-ab06038ca1bb.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Password validation, from heroku dev.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231057333-41225e8d-19ea-43c9-800b-fff5e68c6283.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Password mismatch validation, from heroku dev.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231057589-7d3b03c2-e015-4323-9f27-895574c3281e.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Email in use validation, from heroku<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add before and after screenshots of the Users table when a user edits their profile</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231057800-cdee17f7-2254-4d02-8d5b-d76dc269a563.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of users table before change, take note of username for last user.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231058057-780921ed-90c3-434c-b301-e3bf9aa6a26d.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of edited username for the last user.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add the related pull request(s) for this feature</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/singak1/IT202-008/pull/30">https://github.com/singak1/IT202-008/pull/30</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Explain briefly how the process/code works (edit only)</td></tr>
<tr><td> <em>Response:</em> <p>First for validation, this is almost the same as registration page. Email is<br>a regex that checks for valid email addresses, username makes <br>sure there are<br>atleast 3 lowercase alphanumeric and _- characters, <br>password makes sure there are atleast<br>8 characters and there is match <br>check to make sure the passwords matches.<br>If any of these validations <br>fail the form wont be submitted. If valid<br>data is entered, then we get the user from the table by matching<br>the current users id from the session to the records in the table.<br>Once we have the record we verify password and run an update statement<br>to update the data in the table. For the username and email fields<br>we have to update the table but we also need to get the<br>new data from the table and change our sessions user email and username<br>fields with the updated fields so that they can prefilled properly.<br><br></p><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 9: </em> Issues and Project Board </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots showing which issues are done/closed (project board) Incomplete Issues should not be closed</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/112450716/231059025-e0971a25-e55c-43a5-acfa-4be15844f83e.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of the project board with all 9 main features done and closed.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Include a direct link to your Project Board</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/users/singak1/projects/1">https://github.com/users/singak1/projects/1</a> </td></tr>
<tr><td> <em>Sub-Task 3: </em> Prod Application Link to Login Page</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://as4234-prod.herokuapp.com/project//login.php">https://as4234-prod.herokuapp.com/project//login.php</a> </td></tr>
</table></td></tr>
<table><tr><td><em>Grading Link: </em><a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-008-S23/it202-milestone1-deliverable/grade/as4234" target="_blank">Grading</a></td></tr></table>