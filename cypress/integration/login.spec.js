describe('login', () => {
	before(() => {
		cy.visit('http://localhost:8906');		
	})
	it('should login', () => {
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

	})
})
