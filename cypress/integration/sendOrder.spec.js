describe('sendOrder', () => {
	before(() => {
		cy.visit('http://eshop-example.dev');		
	})
	it('should sendOrder', () => {
		cy.get('[data-test="addToCart"]:eq(0)')
			.should('have.length', 1)
			.and('be.visible')
			.click();

		cy.get('[data-test="cartOpen"]')
			.should('have.length', 1)
			.and('be.visible')
			.click();

		cy.get('[data-test="orderNext"]')
			.should('have.length', 1)
			.and('be.visible')
			.click();

		cy.get('[data-test="delivery"]')
			.should('have.length', 1)
			.and('be.visible')
			.select('Česká pošta');

		cy.get('[data-test="firstname"]')
			.should('have.length', 1)
			.and('be.visible')
			.type('Zbyněk');

		cy.get('[data-test="lastname"]')
			.should('have.length', 1)
			.and('be.visible')
			.type('Rybička');

		cy.get('[data-test="street"]')
			.should('have.length', 1)
			.and('be.visible')
			.type('Součkova 3');

		cy.get('[data-test="zip"]')
			.should('have.length', 1)
			.and('be.visible')
			.type('62400');

		cy.get('[data-test="city"]')
			.should('have.length', 1)
			.and('be.visible')
			.type('Brno');

		cy.get('[data-test="payment"]')
			.should('have.length', 1)
			.and('be.visible')
			.select('Platební karta');

		cy.get('[data-test="sendOrder"]')
			.should('have.length', 1)
			.and('be.visible')
			.click();

	})
})
