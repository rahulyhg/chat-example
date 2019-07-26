describe('addToCart', () => {
	before(() => {
		cy.visit('http://eshop-example.dev');		
	})
	it('should addToCart', () => {
		cy.get('[data-test="addToCart"]:eq(0)')
			.should('have.length', 1)
			.and('be.visible')
			.click();

	})
})
