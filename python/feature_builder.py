import mysql.connector
import pandas as pd

def build_features(learner_id):

    db = mysql.connector.connect(
        host="localhost",
        user="db_user",
        password="db_password",
        database="astraal_lxp"
    )

    query = f"""
    SELECT
        COUNT(*) as engagement_score
    FROM learning_events
    WHERE learner_id={learner_id}
    """

    df = pd.read_sql(query, db)

    df["intent_score"] = 0.8
    df["skill_gap_score"] = 0.5
    df["milestone_progress"] = 0.6
    df["pathway_confidence"] = 0.7
    df["difficulty_delta"] = 0.3

    return df
