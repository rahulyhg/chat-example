describe('registration', () => {
	before(() => {
		cy.visit('http://localhost:8906');		
	})
	it('should registration', () => {
		cy.get('[data-test="registrationLink"]')
			.should('have.length', 1)
			.and('be.visible')
			.click();

		cy.get('[data-test="email"]')
			.should('have.length', 1)
			.and('be.visible')
			.type('zbynek.rybicka@gmail.com');

		cy.get('[data-test="nickname"]')
			.should('have.length', 1)
			.and('be.visible')
			.type('Kossai');

		cy.get('[data-test="username"]')
			.should('have.length', 1)
			.and('be.visible')
			.type('zbynek.rybicka');

		cy.get('[data-test="password"]')
			.should('have.length', 1)
			.and('be.visible')
			.type('solarWindsExample');

		cy.get('[data-test="retype"]')
			.should('have.length', 1)
			.and('be.visible')
			.type('solarWindsExample');

		cy.get('[data-test="register"]')
			.should('have.length', 1)
			.and('be.visible')
			.click();

	})
})
