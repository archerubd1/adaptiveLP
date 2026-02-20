import mysql.connector
import sys

def run_adaptive_engine(learner_id):
    try:
        # 1. Connect to UwAmp MySQL
        db = mysql.connector.connect(
            host="localhost",
            user="root",
            password="root", # UwAmp default
            database="astraal_lxp"
        )
        cursor = db.cursor(dictionary=True)

        # 2. Analyze 'learning_events' to see what the user did
        # For example: Count how many "Coding Ground" clicks occurred
        cursor.execute("SELECT COUNT(*) as activity_count FROM learning_events WHERE learner_id = %s", (learner_id,))
        activity = cursor.fetchone()
        
        # 3. Simple Logic: Increase Skill Maturity based on activity
        # In a real LXP, this would be a Machine Learning model prediction
        new_skill = min(0.95, 0.5 + (activity['activity_count'] * 0.05))
        new_think = min(0.90, 0.4 + (activity['activity_count'] * 0.03))
        new_collab = min(0.85, 0.3 + (activity['activity_count'] * 0.02))

        # 4. Update the 'learner_journey_state' table
        update_query = """
            INSERT INTO learner_journey_state (learner_id, skill_maturity, thinking_complexity, collaboration_index)
            VALUES (%s, %s, %s, %s)
            ON DUPLICATE KEY UPDATE 
                skill_maturity = VALUES(skill_maturity),
                thinking_complexity = VALUES(thinking_complexity),
                collaboration_index = VALUES(collaboration_index)
        """
        cursor.execute(update_query, (learner_id, new_skill, new_think, new_collab))
        
        # 5. Generate a new Recommendation
        rec_text = "Master Advanced PHP Architecture" if new_skill > 0.7 else "Intro to Procedural Logic"
        cursor.execute("INSERT INTO adaptive_recommendations (learner_id, recommendation_text, rationale, rank_score) VALUES (%s, %s, %s, 0.99)", 
                       (learner_id, rec_text, "Based on your latest activity recalibration."))

        db.commit()
        print(f"Success: Updated learner {learner_id}")

    except Exception as e:
        print(f"Error: {str(e)}")
    finally:
        if db.is_connected():
            cursor.close()
            db.close()

if __name__ == "__main__":
    # Get learner_id from PHP command line argument
    uid = sys.argv[1] if len(sys.argv) > 1 else 1
    run_adaptive_engine(uid)