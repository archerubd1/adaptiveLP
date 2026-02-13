CREATE DATABASE astraal_lxp;
USE astraal_lxp;

CREATE TABLE learners (
    learner_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    created_on DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE learning_events (
    event_id INT AUTO_INCREMENT PRIMARY KEY,
    learner_id INT,
    event_type VARCHAR(50),
    event_value FLOAT,
    source VARCHAR(50),
    created_on DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE learner_journey_state (
    learner_id INT PRIMARY KEY,
    intent_score FLOAT DEFAULT 0,
    skill_gap_score FLOAT DEFAULT 0,
    engagement_score FLOAT DEFAULT 0,
    milestone_progress FLOAT DEFAULT 0,
    pathway_confidence FLOAT DEFAULT 0,
    last_updated DATETIME
);

CREATE TABLE adaptive_recommendations (
    learner_id INT,
    recommendation_type VARCHAR(50),
    recommendation_text TEXT,
    rank_score FLOAT,
    rationale TEXT,
    generated_on DATETIME
);

CREATE TABLE faculty_overrides (
    override_id INT AUTO_INCREMENT PRIMARY KEY,
    learner_id INT,
    original_recommendation TEXT,
    overridden_recommendation TEXT,
    reason TEXT,
    overridden_by INT,
    overridden_on DATETIME
);
