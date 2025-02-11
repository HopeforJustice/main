<?php

/**
 * Template Name: One off Norway
 *
 * @package Hope_for_Justice_2021
 */

get_header("", ["page_class" => "site--full"]); ?>

<?php
$campaignPassed = $_COOKIE["wordpress_hfjcampaign"];
$urlWidget = $_GET["wid"];
$image = $_GET["image"];

$matched_widget;
if (have_rows("campaigns_and_widgets")):
	while (have_rows("campaigns_and_widgets")):
		the_row();
		$campaign = get_sub_field("campaign_name");
		$widget = get_sub_field("widget_id");

		if ($campaignPassed == $campaign) {
			$matched_widget = $widget;
		}
	endwhile;
endif;

if ($urlWidget):
	$matched_widget = $urlWidget;
endif;
?>



<script type="text/javascript" src="https://js.stripe.com/v3/"></script>
<script src="https://www.google.com/recaptcha/api.js?render=6LeSscYZAAAAABIur1rDAvJtDiR7SayCuAylTV2q"></script>

<div class="main site-main donorfy-donate">
    <div class="donorfy-donate__grid">
        <div class="grid donorfy-donate__inner-grid">
            <div class="donorfy-donate__forms">

                <div class="donorfy-donate__dots">
                    <div id="dotOne" class="donorfy-donate__dot donorfy-donate__dot--active"></div>
                    <div id="dotTwo" class="donorfy-donate__dot"></div>
                    <div id="dotThree" class="donorfy-donate__dot"></div>
                    <div id="dotFour" class="donorfy-donate__dot"></div>
                </div>



                <!-- form 1 -->
                <form id="formOne">

                    <div class="donorfy-donate__giving-text">
                        Du gir <span id="textAmount"><?php echo $_GET[
                        	"Amount"
                        ]; ?></span> kr
                        <a id="changeAmount">Endre beløp</a>
                    </div>
                    <h2 class="font-canela">Dine detaljer</h2>

                    <div class="donorfy-donate__amount donorfy-donate__input donorfy-donate__amount--norway">
                        <label class="donorfy-donate__hidden" for="Amount">Amount I would like to give</label>
                        <input type="text" name="Amount" class="required" id="NorwayAmount" maxlength="10" <?php if (
                        	$_GET["Amount"]
                        ) { ?> value="<?php echo $_GET[
 	"Amount"
 ]; ?>" <?php } ?>>
                    </div>

                    <div style="display: none;">
                        <input type="text" name="Amount" class="required numberOnly form-control" id="Amount" maxlength="10">
                    </div>

                    <!--                     <label class="donorfy-donate__hidden" for="Title">Title</label>

                    <div class="donorfy-donate__select">
                        <select type="text" name="Title" id="Title">
                            <option value="">Title (Optional)</option>
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Miss">Miss</option>
                            <option value="Ms">Ms</option>
                            <option value="Dr">Dr</option>
                            <option value="Bishop">Bishop</option>
                            <option value="Friar">Friar</option>
                            <option value="Councillor">Councillor</option>
                            <option value="Professor">Professor</option>
                            <option value="Sir">Sir</option>
                            <option value="Lady">Lady</option>
                               
                        </select>
                    </div> -->

                    <div class="donorfy-donate__flex">
                        <div class="donorfy-donate__input">
                            <label class="donorfy-donate__hidden" for="FirstName">Fornavn*</label>
                            <input type="text" name="FirstName" class="required" id="FirstName" placeholder="Fornavn" maxlength="50">
                        </div>
                        <div class="donorfy-donate__input">
                            <label class="donorfy-donate__hidden" for="LastName">Etternavn*</label>
                            <input type="text" name="LastName" class="required" id="LastName" placeholder="Etternavn" maxlength="50">
                        </div>
                    </div>

                    <div class="donorfy-donate__input">
                        <label class="donorfy-donate__hidden" for="Email">E-post*</label>
                        <input type="text" name="Email" class="required" type="email" id="Email" maxlength="50" placeholder="E-post">
                    </div>


                    <div class="donorfy-donate__input">
                        <label class="donorfy-donate__hidden" for="Phone">Telefon</label>
                        <input type="text" name="Phone" class="" id="Phone" maxlength="50" placeholder="Telefon">
                    </div>

                    <div class="donorfy-donate__buttons">
                        <div id="toStepTwo" class="button button--spinner button--red">Neste</div>
                    </div>
                </form>
                <!-- /form 1 -->


                <!-- form 2 -->
                <form id="formTwo">
                    <h2 class="font-canela">Adresse</h2>

                    <p class="donorfy-donate__larger donorfy-donate__larger--mb">
                        Denne informasjonen er nødvendig for å behandle betalingen. Vi vil ikke sende deg noe per post.
                    </p>

                    <div class="donorfy-donate__input">
                        <label class="donorfy-donate__hidden" for="Address1">Address</label>
                        <input type="text" name="Address1" class="required" id="Address1" maxlength="50" placeholder="Adresse">
                    </div>

                    <div class="donorfy-donate__input donorfy-donate__hidden">
                        <label class="donorfy-donate__hidden" for="Address1">Address 2</label>
                        <input type="text" name="Address2" class="" id="Address2" maxlength="50" placeholder="Address 2 (optional)">
                    </div>

                    <div class="donorfy-donate__flex">
                        <div class="donorfy-donate__input">
                            <label class="donorfy-donate__hidden" for="Town">Town</label>
                            <input type="text" name="Town" class="required" id="Town" maxlength="50" placeholder="Poststed">
                        </div>

                        <div class="donorfy-donate__input">
                            <label class="donorfy-donate__hidden" for="Postcode">Postcode</label>
                            <input type="text" name="Postcode" class="required justCapsPostcode" id="Postcode" maxlength="10" placeholder="Postnummer">
                        </div>
                    </div>

                    <label class="donorfy-donate__hidden" for="County">County</label>
                    <input class="donorfy-donate__hidden" type="text" name="County" class="" id="County" maxlength="50">

                    <div class="donorfy-donate__select">
                        <select name="Country" class="required" id="Country" placeholder="Country">
                            <option disabled value=""> -- Country select -- </option>
                            <option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option>
                            <option value="Algeria">Algeria</option>
                            <option value="American Samoa">American Samoa</option>
                            <option value="Andorra">Andorra</option>
                            <option value="Angola">Angola</option>
                            <option value="Anguilla">Anguilla</option>
                            <option value="Antarctica">Antarctica</option>
                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option>
                            <option value="Aruba">Aruba</option>
                            <option value="Australia">Australia</option>
                            <option value="Austria">Austria</option>
                            <option value="Azerbaijan">Azerbaijan</option>
                            <option value="Bahamas">Bahamas</option>
                            <option value="Bahrain">Bahrain</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option>
                            <option value="Benin">Benin</option>
                            <option value="Bermuda">Bermuda</option>
                            <option value="Bhutan">Bhutan</option>
                            <option value="Bolivia">Bolivia</option>
                            <option value="Bonaire, Saint Eustatius and Saba">Bonaire, Saint Eustatius and Saba</option>
                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Bouvet Island">Bouvet Island</option>
                            <option value="Brazil">Brazil</option>
                            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                            <option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option>
                            <option value="Burundi">Burundi</option>
                            <option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option>
                            <option value="Canada">Canada</option>
                            <option value="Cape Verde">Cape Verde</option>
                            <option value="Cayman Islands">Cayman Islands</option>
                            <option value="Central African Republic">Central African Republic</option>
                            <option value="Chad">Chad</option>
                            <option value="Chile">Chile</option>
                            <option value="China">China</option>
                            <option value="Christmas Island">Christmas Island</option>
                            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Comoros">Comoros</option>
                            <option value="Congo">Congo</option>
                            <option value="Congo, the Democratic Republic of the">Congo, the Democratic Republic of the</option>
                            <option value="Cook Islands">Cook Islands</option>
                            <option value="Costa Rica">Costa Rica</option>
                            <option value="Croatia">Croatia</option>
                            <option value="Cuba">Cuba</option>
                            <option value="Curaçao">Curaçao</option>
                            <option value="Cyprus">Cyprus</option>
                            <option value="Czech Republic">Czech Republic</option>
                            <option value="Côte D'ivoire">Côte D'ivoire</option>
                            <option value="Denmark">Denmark</option>
                            <option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option>
                            <option value="Dominican Republic">Dominican Republic</option>
                            <option value="Ecuador">Ecuador</option>
                            <option value="Egypt">Egypt</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                            <option value="Eritrea">Eritrea</option>
                            <option value="Estonia">Estonia</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                            <option value="Faroe Islands">Faroe Islands</option>
                            <option value="Fiji">Fiji</option>
                            <option value="Finland">Finland</option>
                            <option value="France">France</option>
                            <option value="French Guiana">French Guiana</option>
                            <option value="French Polynesia">French Polynesia</option>
                            <option value="French Southern Territories">French Southern Territories</option>
                            <option value="Gabon">Gabon</option>
                            <option value="Gambia">Gambia</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option>
                            <option value="Ghana">Ghana</option>
                            <option value="Gibraltar">Gibraltar</option>
                            <option value="Greece">Greece</option>
                            <option value="Greenland">Greenland</option>
                            <option value="Grenada">Grenada</option>
                            <option value="Guadeloupe">Guadeloupe</option>
                            <option value="Guam">Guam</option>
                            <option value="Guatemala">Guatemala</option>
                            <option value="Guernsey">Guernsey</option>
                            <option value="Guinea">Guinea</option>
                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                            <option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option>
                            <option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                            <option value="Holland">Holland</option>
                            <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                            <option value="Honduras">Honduras</option>
                            <option value="Hong Kong">Hong Kong</option>
                            <option value="Hungary">Hungary</option>
                            <option value="Iceland">Iceland</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Iran, Islamic Republic Of">Iran, Islamic Republic Of</option>
                            <option value="Iraq">Iraq</option>
                            <option value="Ireland">Ireland</option>
                            <option value="Isle of Man">Isle of Man</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option>
                            <option value="Japan">Japan</option>
                            <option value="Jersey">Jersey</option>
                            <option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Kiribati">Kiribati</option>
                            <option value="Kuwait">Kuwait</option>
                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Laos">Laos</option>
                            <option value="Latvia">Latvia</option>
                            <option value="Lebanon">Lebanon</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option>
                            <option value="Libya">Libya</option>
                            <option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option>
                            <option value="Luxembourg">Luxembourg</option>
                            <option value="Macao">Macao</option>
                            <option value="Macedonia">Macedonia</option>
                            <option value="Madagascar">Madagascar</option>
                            <option value="Malawi">Malawi</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option>
                            <option value="Malta">Malta</option>
                            <option value="Marshall Islands">Marshall Islands</option>
                            <option value="Martinique">Martinique</option>
                            <option value="Mauritania">Mauritania</option>
                            <option value="Mauritius">Mauritius</option>
                            <option value="Mayotte">Mayotte</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Micronesia">Micronesia</option>
                            <option value="Moldova">Moldova</option>
                            <option value="Monaco">Monaco</option>
                            <option value="Mongolia">Mongolia</option>
                            <option value="Montenegro">Montenegro</option>
                            <option value="Montserrat">Montserrat</option>
                            <option value="Morocco">Morocco</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="Myanmar">Myanmar</option>
                            <option value="Namibia">Namibia</option>
                            <option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Netherlands">Netherlands</option>
                            <option value="New Caledonia">New Caledonia</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option>
                            <option value="Nigeria">Nigeria</option>
                            <option value="Niue">Niue</option>
                            <option value="Norfolk Island">Norfolk Island</option>
                            <option value="North Korea">North Korea</option>
                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                            <option selected value="Norway">Norge</option>
                            <option value="Oman">Oman</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Palau">Palau</option>
                            <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                            <option value="Panama">Panama</option>
                            <option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option>
                            <option value="Peru">Peru</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Pitcairn">Pitcairn</option>
                            <option value="Poland">Poland</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Puerto Rico">Puerto Rico</option>
                            <option value="Qatar">Qatar</option>
                            <option value="Romania">Romania</option>
                            <option value="Russian Federation">Russian Federation</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="Réunion">Réunion</option>
                            <option value="Saint Barthélemy">Saint Barthélemy</option>
                            <option value="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option>
                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                            <option value="Saint Lucia">Saint Lucia</option>
                            <option value="Saint Martin (French part)">Saint Martin (French part)</option>
                            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                            <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                            <option value="Samoa">Samoa</option>
                            <option value="San Marino">San Marino</option>
                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option>
                            <option value="Senegal">Senegal</option>
                            <option value="Serbia">Serbia</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sierra Leone">Sierra Leone</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option>
                            <option value="Slovakia">Slovakia</option>
                            <option value="Slovenia">Slovenia</option>
                            <option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                            <option value="South Korea">South Korea</option>
                            <option value="South Sudan">South Sudan</option>
                            <option value="Spain">Spain</option>
                            <option value="Sri Lanka">Sri Lanka</option>
                            <option value="Sudan">Sudan</option>
                            <option value="Suriname">Suriname</option>
                            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                            <option value="Swaziland">Swaziland</option>
                            <option value="Sweden">Sweden</option>
                            <option value="Switzerland">Switzerland</option>
                            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                            <option value="Taiwan, Province Of China">Taiwan, Province Of China</option>
                            <option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania">Tanzania</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Timor-Leste">Timor-Leste</option>
                            <option value="Togo">Togo</option>
                            <option value="Tokelau">Tokelau</option>
                            <option value="Tonga">Tonga</option>
                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tunisia">Tunisia</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option>
                            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                            <option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                            <option value="United States">United States</option>
                            <option value="Uruguay">Uruguay</option>
                            <option value="Uzbekistan">Uzbekistan</option>
                            <option value="Vanuatu">Vanuatu</option>
                            <option value="Venezuela">Venezuela</option>
                            <option value="Vietnam">Vietnam</option>
                            <option value="Virgin Islands, British">Virgin Islands, British</option>
                            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                            <option value="Wallis and Futuna">Wallis and Futuna</option>
                            <option value="Western Sahara">Western Sahara</option>
                            <option value="Yemen">Yemen</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
                            <option value="Åland Islands">Åland Islands</option>
                        </select>
                    </div>

                    <div class="donorfy-donate__buttons">
                        <div id="backToStepOne" class="button button--spinner button--white">Forrige</div>
                        <div id="toStepThree" class="button button--spinner">Neste</div>
                    </div>

                </form>
                <!-- /form 2 -->



                <!--                 <form id="formThree">
                    <h2 class="font-canela">Gift Aid:</h2>

                    <p class="donorfy-donate__larger donorfy-donate__larger--mb">Boost your donation by 25p for every £1 you donate, at no extra cost to you. Do you want to Gift Aid this donation?</p>

                    <div class="donorfy-donate__select">
                        <select id="GiftAidSelect" class="required">
                            <option value="">-- Select option --</option>
                            <option value="true">Yes please</option>
                            <option value="false">No thank you</option>
                        </select>
                    </div>
                    
                    <p class="donorfy-donate__small-text">
                        <br>
                        Please add Gift Aid to all donations I’ve made to Hope for Justice in the past four years and all donations in future until I notify Hope for Justice otherwise.
                        <br><br>
                        By selecting 'Yes', I confirm that I am a UK taxpayer and understand that if I pay less Income Tax and/or Capital Gains Tax than the amount of Gift Aid claimed on all my donations in the tax year, it is my responsibility to pay any difference. I confirm that this is my own money and I am not paying over donations made by third parties such as monies collected at an event, a company donation or a donation from a friend or family member. I am not receiving anything in return for my donation such as a book, prize or ticket. I am not making a donation as part of a sweepstake, raffle or lottery.
                    </p>

                    <div class="donorfy-donate__buttons">
                        <div id="backToStepTwo" class="button button--spinner button--white">Previous</div>
                        <div id="toStepFour" class="button button--spinner">Next</div>
                    </div>
                </form> -->


                <!-- form 4 -->
                <form id="formThree">

                    <h2 class="font-canela">Motta oppdateringer fra oss</h2>
                    <p class="donorfy-donate__larger donorfy-donate__preferences-preview-text">Vi vil gjerne fortelle hvordan din gave bidrar til å gjøre slutt på moderne slaveri. Velg dine preferanser for hvordan vi kan holde deg oppdatert:</p>

                    <div class="donorfy-donate__preferences">
                        <div class="donorfy-donate__preference">
                            <p class="donorfy-donate__select-text">E-post:</p>
                            <div class="donorfy-donate__select donorfy-donate__select--preference">
                                <select id="emailSelect" class="required" name="emailSelect">
                                    <option value="">Velg</option>
                                    <option value="true">Ja</option>
                                    <option value="false">Nei</option>
                                </select>
                            </div>
                        </div>

                        <div class="donorfy-donate__preference">
                            <p class="donorfy-donate__select-text">Post:</p>
                            <div class="donorfy-donate__select donorfy-donate__select--preference">
                                <select id="postSelect" class="required" name="postSelect">
                                    <option value="">Velg</option>
                                    <option value="true">Ja</option>
                                    <option value="false">Nei</option>
                                </select>
                            </div>
                        </div>

                        <div class="donorfy-donate__preference">
                            <p class="donorfy-donate__select-text">SMS:</p>
                            <div class="donorfy-donate__select donorfy-donate__select--preference">
                                <select id="smsSelect" class="required" name="smsSelect">
                                    <option value="">Velg</option>
                                    <option value="true">Ja</option>
                                    <option value="false">Nei</option>
                                </select>
                            </div>
                        </div>

                        <div class="donorfy-donate__preference">
                            <p class="donorfy-donate__select-text">Telefon:</p>
                            <div class="donorfy-donate__select donorfy-donate__select--preference">
                                <select id="phoneSelect" class="required" name="phoneSelect">
                                    <option value="">Velg</option>
                                    <option value="true">Ja</option>
                                    <option value="false">Nei</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <p class="donorfy-donate__small-text">
                        Velg “ja” dersom du ønsker at Hope for Justice skal kontakte deg i henhold til dine preferanser: for å holde deg informert om våre pågående aktiviteter, nyheter og kampanjer, og for å invitere deg til relevante arrangementer. Du kan når som helst endre dine preferanser eller melde deg av fra å motta kommunikasjon fra oss på: <a href="https://hopeforjustice.org/manage-your-preferences">hopeforjustice.org/manage-your-preferences</a>
                        <br><br>
                        Vi lagrer dine personopplysninger sikkert. Vi vil bruke den til å tilby tjenesten(e) du har bedt om, og kommunisere med deg på den måten(e) du har samtykket til. Vi vil kun tillate at informasjonen din brukes av tredjeparter som jobber på våre vegne. Vi deler informasjonen din hvis det er påkrevd i henhold til loven. For detaljer, se vår <a href="/privacy-policy">personvernerklæring</a>
                    </p>

                    <div class="donorfy-donate__buttons">
                        <div id="backToStepTwo" class="button button--spinner button--white">Forrige</div>
                        <div id="toStepFour" class="button button--spinner">Neste</div>
                    </div>

                </form>


                <!-- form 4 -->
                <form id="CreditCardForm">


                    <h2 class="font-canela">Kortdetaljer</h2>

                    <div id="card-number" class="donorfy-donate__input"></div>

                    <div class="donorfy-donate__flex">
                        <div id="card-expiry" class="donorfy-donate__input"></div>
                        <div id="card-cvc" class="donorfy-donate__input"></div>
                    </div>

                    <div id="payment-request-button" class="donorfy-donate__apple-google-pay">
                        <!-- Target for apple & google pay -->
                    </div>

                    <div id="paypal-button-container">
                        <!-- Target for PayPal buttons -->
                    </div>

                    <!--<label class="donorfy-donate__hidden" for="inspiration_question">What inspired you to give?</label>
                    <div class="donorfy-donate__select">
                        <select name="inspiration_question" id="inspiration_question">
                            <option value="">What inspired you to give? (optional)</option>
                            <option value="Inspiration_Faith">Faith based</option>
                            <option value="Inspiration_SocialMedia">Social media</option>
                            <option value="Inspiration_StaffContact">I know a Hope for Justice staff member/ volunteer</option>
                            <option value="Inspiration_Celebration">Gift of celebration</option>
                            <option value="Inspiration_Cause">Passion to end modern slavery</option>
                            <option value="Inspiration_Event">Event or talk</option>
                            <option value="Inspiration_Other">Other</option>
                        </select>
                    </div> -->

                    <div class="donorfy-donate__input">
                        <textarea rows="2" cols="40" class="" name="Comment" id="Comment" placeholder="What inspired you to give?"></textarea>
                    </div>


                    <h3 class="donorfy-donate__summary-title">Oppsummering</h3>
                    <div class="donorfy-donate__summary-hr">
                        <hr>
                    </div>
                    <div class="donorfy-donate__summary-text">
                        Totalsum: <b><span id="donationTotalConfirm"><?php echo $_GET[
                        	"Amount"
                        ]; ?></span> kr</b>
                        <br>
                        Status: <b><span id="givingFrequencyConfirm">enkeltgave</span></b>
                    </div>


                    <div class="donorfy-donate__hidden">
                        <input id="emailPreference" type="checkbox" value="2" class="KeepInTouch">
                        &nbsp;Email
                        <input id="postPreference" type="checkbox" value="4" class="KeepInTouch">&nbsp;Post
                        <input id="smsPreference" type="checkbox" value="8" class="KeepInTouch">&nbsp;Sms
                        <input id="phonePreference" type="checkbox" value="16" class="KeepInTouch">&nbsp;Phone
                    </div>

                    <div id="ErrorContainer" class="ErrorContainer">
                        <div style="color: red; font-size: 1.5em;" id="Errors"></div>
                    </div>

                    <!-- <div id="PleaseWait" style="display:none">Please wait ...</div> -->


                    <div class="donorfy-donate__buttons">
                        <div id="backToStepThree" class="button button--white button--spinner">Forrige</div>
                        <button id="submitButton" class="button button--spinner">Donate</button>
                    </div>


                    <div style="display: none;">
                        <input type="radio" id="OneOffPayment" name="PaymentType" value="OneOff" checked="checked">
                        <input type="radio" id="RecurringPayment" name="PaymentType" value="Recurring">
                    </div>

                    <div id="PaymentScheduleRow" style="display: none;">
                        <input type="radio" id="MonthlyPayment" name="PaymentSchedule" value="Monthly">
                        <input type="radio" id="QuarterlyPayment" name="PaymentSchedule" value="Quarterly">
                        <input type="radio" id="AnnualPayment" name="PaymentSchedule" value="Annually">
                    </div>



                    <!-- Hidden fields for tags -->
                    <input type="hidden" id="ActiveTags" value="" />
                    <input type="hidden" id="BlockedTags" value="" />
                    <!-- Do not change these values -->
                    <input type="hidden" id="TenantCode" value="N2SOZ58ZN2" />
                    <input type="hidden" id="PublishableKey" value="pk_live_514W8C9K2ySHtDs1HCrbmaPd0nq8Z3VCYOENd4YfkL5u9rJei4bQzrbX7TPqDFEeDYFJ6Fs3Y5bH54rojuEu4nw6g00SjtVOUha" />


                    <input type="hidden" id="WidgetId" value="<?php if (
                    	$matched_widget
                    ) {
                    	echo $matched_widget;
                    } else {
                    	echo "a162845d-52b5-ee11-a81c-000d3ada8395";
                    } ?>" />


                    <input type="hidden" id="DonationPageId" value="" />
                    <!-- <input type="hidden" id="RedirectToPage" value="http://hopeforjustice.org/thank-you-usa-regular" /> -->
                    <input type="hidden" id="ReCaptchaSiteKey" value="6LeSscYZAAAAABIur1rDAvJtDiR7SayCuAylTV2q" />
                    <input type="hidden" id="ReCaptchaAction" value="Donorfy" />

                    <input type="hidden" id="currency" value="NOK" />
                    <input type="hidden" id="type" value="Norway+one-off" />
                    <input type="hidden" id="zapierUrl" value="" />

                    <input type="hidden" id="StripePaymentIntentId" value="" />
                    <input type="hidden" id="PaymentMethod" value="" />
                    <input type="hidden" id="StripeStatementText" value="Hope for Justice" />
                    <input type="hidden" id="CurrencyCode" value="nok" />
                    <input type="hidden" id="CountryCode" value="NO" />
                    <input type="hidden" id="PayPalStatementText" value="Hope for Justice" />
                    <input type="hidden" id="PayPalClientId" value="AaQzhULMlg_dYWzkSmm06sKuUrqAaMdzyUW_E9OPMlmxroQoipJ5v5CX9u6yzcK7oZJc36aXK4Rn8Y3j" />
                    <input type="hidden" id="ExternalPaymentReference" value="" />
                    <input type="hidden" id="PayPal" value="" />
                </form>
                <!-- /form 3 -->

            </div>

            <div class="donorfy-donate__secure">
                <svg xmlns="http://www.w3.org/2000/svg" width="10.667" height="14" viewBox="0 0 10.667 14">
                    <g id="Group_7324" data-name="Group 7324" transform="translate(-160 -720)">
                        <g id="Group_7323" data-name="Group 7323" transform="translate(160 720)">
                            <path id="Path_17203" data-name="Path 17203" d="M2,0H8.667a2,2,0,0,1,2,2V7.333a2,2,0,0,1-2,2H2a2,2,0,0,1-2-2V2A2,2,0,0,1,2,0Z" transform="translate(0 4.667)" fill="#212322" />
                            <path id="Union_1" data-name="Union 1" d="M5.333,7.334V3.467a2.072,2.072,0,0,0-2-2.134,2.072,2.072,0,0,0-2,2.134V7.334h4M6.666,8.667H0v-5.2A3.4,3.4,0,0,1,3.333,0,3.4,3.4,0,0,1,6.666,3.467Z" transform="translate(2 0)" fill="#212322" />
                        </g>
                    </g>
                </svg>
                <div>SSL Secure donation</div>
            </div>
        </div><!-- /inner-grid -->

        <div style="background-image: url(<?php if ($image) {
        	echo $image;
        } else {
        	echo "https://hopeforjustice.org/wp-content/uploads/2022/05/donate-pic.jpg";
        } ?>);" class="donorfy-donate__photo">
            <!-- replace with responsive image markup -->
            <h3 class="donorfy-donate__photo-text font-canela">End Slavery.<br>Change Lives.</h3>
        </div>

    </div><!-- /grid -->

</div>

<script>
    function InitialiseForm() {}
</script>



<?php get_footer(); ?>
