import { Header } from "creode-components";

jQuery('document').ready(
	() => {
		jQuery('.header__wrapper').each(
			function() {
				new Header(jQuery(this));
			}
		);
	}
);
