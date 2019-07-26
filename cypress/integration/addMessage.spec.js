describe('addMessage', () => {
	before(() => {
		cy.visit('http://localhost:8906');		
	})
	it('should addMessage', () => {
		cy.get('[data-test="username"]')
			.should('have.length', 1)
			.and('be.visible')
			.type('zbynek.rybicka');

		cy.get('[data-test="password"]')
			.should('have.length', 1)
			.and('be.visible')
			.type('solarWindsExample');

		cy.get('[data-test="login"]')
			.should('have.length', 1)
			.and('be.visible')
			.click();

		cy.get('[data-test="message"]')
			.should('have.length', 1)
			.and('be.visible')
			.type('Toto je zkušební zpráva');

		cy.get('[data-test="addMessage"]')
			.should('have.length', 1)
			.and('be.visible')
			.click();

	})
})
