<?php
/**
 * Template Name: TBCO
 *
 * @package Hope_for_Justice_2021
 */

get_header("", ["page_class" => "tbco"]); ?>

<main id="main" class="site-main tbco__main" role="main">
    			<?php if (
       	isset($_GET["form-complete"]) &&
       	$_GET["form-complete"] === "true"
       ) {
       	echo '<div class="tbco__toast"><div>Your church resources pack is on the way!</div></div>';
       } ?>
<div class="tbco__hero">
	<div class="better-grid">

		<div class="tbco__logo">
            <img src="<?php echo get_template_directory_uri() .
            	"/assets/img/logo-tbco.svg"; ?>" alt="TBCO logo" class="tbco__svg">
        </div>

		<h1 class="tbco__title font-fk">
            We will be the generation to end human trafficking
        </h1>

        <div class="tbco__buttons">
            <a href="/tbco-donate" class="button button--red tbco__donate-button">
                Donate now  
            </a>
            <a href="/tbco-church-pack-request/" class="button button--white">
                <div class="button__inner">
                    <div class="button__text bold red">
                        Get your free church pack
                    </div>
                </div>
            </a>
            <a href="/get-involved" class="button button--plain tbco__plain-button">More ways to get involved</a>
        </div>
	</div> <!-- /grid -->
</div>
<div class="tbco__natalie">
    <div class="tbco__natalie-inner better-grid">
        <h2 class="font-canela">
            “I commit my life to Proverbs 31:8 which says ‘Speak up for those who cannot speak for themselves. Ensure justice for those being crushed.’ I have seen those who are crushed, and I say that together, we must do whatever it takes to give them justice.”
        </h2>
        <p>Natalie Grant, Co-Founder and Global Ambassador, Hope for Justice</p>
    </div>
</div>

</main>

<?php get_footer(); ?>
